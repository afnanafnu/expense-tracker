<!DOCTYPE html>
<html>
<head>
    <title>Expense Report</title>
    <style>
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>

<h2>Expense Report</h2>
<p>Month: {{ $month }} / {{ $year }}</p>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Category</th>
            <th>Title</th>
            <th>Amount</th>
        </tr>
    </thead>

    <tbody>
        @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->transaction_date->format('Y-m-d') }}</td>
                <td>{{ $entry->category?->name ?? 'Uncategorised' }}</td>
                <td>{{ $entry->title }}</td>
                <td>{{ $entry->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>