<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ContactController extends Controller
{
    public function dashboard(Request $request): View
    {
        $userId = $request->user()->id;

        $contactsQuery = Contact::where('user_id', $userId);

        $totalContacts = (clone $contactsQuery)->count();
        $newThisMonth = (clone $contactsQuery)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $topCompanies = (clone $contactsQuery)
            ->selectRaw('company, count(*) as total')
            ->whereNotNull('company')
            ->groupBy('company')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $recentContacts = (clone $contactsQuery)
            ->latest()
            ->limit(5)
            ->get();

        $months = [];
        $monthTotals = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M');
            $monthTotals[] = (clone $contactsQuery)
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        $stageCounts = (clone $contactsQuery)
            ->selectRaw('stage, count(*) as total')
            ->groupBy('stage')
            ->pluck('total', 'stage');

        return view('dashboard', [
            'totalContacts' => $totalContacts,
            'newThisMonth' => $newThisMonth,
            'topCompanies' => $topCompanies,
            'recentContacts' => $recentContacts,
            'chartMonths' => $months,
            'chartTotals' => $monthTotals,
            'stageLabels' => $stageCounts->keys()->values(),
            'stageTotals' => $stageCounts->values(),
        ]);
    }

    public function index(Request $request): View
    {
        $userId = $request->user()->id;

        $query = Contact::where('user_id', $userId)
            ->search($request->input('q'));

        if ($company = $request->input('company')) {
            $query->where('company', $company);
        }

        if ($month = $request->input('month')) {
            $query->whereMonth('created_at', $month);
        }

        if ($from = $request->input('from')) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to = $request->input('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        $contacts = $query->latest()->paginate(10)->withQueryString();

        $companies = Contact::where('user_id', $userId)
            ->whereNotNull('company')
            ->distinct()
            ->orderBy('company')
            ->pluck('company');

        return view('contacts.index', [
            'contacts' => $contacts,
            'filters' => $request->only(['q', 'company', 'month', 'from', 'to']),
            'companies' => $companies,
        ]);
    }

    public function create(): View
    {
        return view('contacts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['user_id'] = $request->user()->id;
        $data['owner_id'] = $request->user()->id;
        $data['stage'] = $data['stage'] ?? 'lead';

        Contact::create($data);

        return redirect()->route('contacts.index')->with('status', 'Contact created successfully.');
    }

    public function edit(Contact $contact): View
    {
        $this->authorizeContact($contact);

        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $this->authorizeContact($contact);

        $payload = $this->validated($request, $contact->id);
        $payload['owner_id'] = $contact->owner_id ?? $request->user()->id;
        $contact->update($payload);

        return redirect()->route('contacts.index')->with('status', 'Contact updated.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $this->authorizeContact($contact);
        $contact->delete();

        return redirect()->route('contacts.index')->with('status', 'Contact removed.');
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv'],
        ]);

        $userId = $request->user()->id;
        $path = $request->file('file')->store('imports');
        $fullPath = Storage::path($path);

        $spreadsheet = IOFactory::load($fullPath);
        $rows = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $created = 0;
        $updated = 0;

        // Expect headers: Name, Email, Phone, Company, Address, Notes, Stage, Job title, Source, Tags, Last contacted at
        foreach ($rows as $index => $row) {
            if ($index === 1) {
                continue; // header row from spreadsheet
            }

            $name = trim($row['A'] ?? '');
            if ($name === '') {
                continue;
            }

            $payload = [
                'name' => $name,
                'email' => trim($row['B'] ?? '') ?: null,
                'phone' => trim($row['C'] ?? '') ?: null,
                'company' => trim($row['D'] ?? '') ?: null,
                'address' => trim($row['E'] ?? '') ?: null,
                'notes' => trim($row['F'] ?? '') ?: null,
                'stage' => trim($row['G'] ?? '') ?: 'lead',
                'job_title' => trim($row['H'] ?? '') ?: null,
                'source' => trim($row['I'] ?? '') ?: null,
                'tags' => trim($row['J'] ?? '') ?: null,
                'owner_id' => $userId,
                'user_id' => $userId,
            ];

            $lastContactedRaw = trim($row['K'] ?? '');
            if ($lastContactedRaw !== '') {
                try {
                    $payload['last_contacted_at'] = Carbon::parse($lastContactedRaw);
                } catch (\Exception $e) {
                    // ignore malformed date
                }
            }

            $contact = Contact::where('user_id', $userId)
                ->where(function ($q) use ($payload) {
                    $q->where('email', $payload['email'])
                        ->orWhere('phone', $payload['phone']);
                })
                ->first();

            if ($contact) {
                $contact->update($payload);
                $updated++;
            } else {
                Contact::create($payload);
                $created++;
            }
        }

        Storage::delete($path);

        return redirect()
            ->route('contacts.index')
            ->with('status', "Import complete: {$created} created, {$updated} updated.");
    }

    private function validated(Request $request, ?int $contactId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'stage' => ['nullable', 'string', 'max:50'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'source' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'string'],
            'last_contacted_at' => ['nullable', 'date'],
        ]);
    }

    private function authorizeContact(Contact $contact): void
    {
        if ($contact->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
