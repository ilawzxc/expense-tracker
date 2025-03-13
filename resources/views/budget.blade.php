<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker and Budgeting</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-300 to-blue-500 flex items-center justify-center min-h-screen">

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Expense Tracker and Budgeting</h1>

        <div class="grid md:grid-cols-3 gap-6">
             <!-- Add Budget -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Add Budget</h2>
                <form method="POST" action="{{ route('add-budget') }}">
                    @csrf
                    <input type="number" name="budget" placeholder="Enter Budget" class="w-full p-2 border rounded mb-2">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        Add Budget
                    </button>
                </form>
            </div>

            <!-- Add Expense -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Add Expense</h2>
                <form method="POST" action="{{ route('add-expense') }}">
                    @csrf
                    <input type="text" name="title" placeholder="Expense Title" class="w-full p-2 border rounded mb-2">
                    <input type="number" name="amount" placeholder="Amount" class="w-full p-2 border rounded mb-2">
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
                        Add Expense
                    </button>
                </form>
                <form method="POST" action="{{ route('reset') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 text-white py-2 rounded mt-4 hover:bg-red-600">
                        Reset All
                    </button>
                </form>
            </div>

            <!-- Budget Summary -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div class="bg-blue-100 p-3 rounded">
                        <p class="text-gray-600">Total Budget:</p>
                        <p class="font-semibold text-lg">${{ $total_budget }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded">
                        <p class="text-gray-600">Total Expense:</p>
                        <p class="font-semibold text-lg">${{ $total_expense }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded">
                        <p class="text-gray-600">Budget Left:</p>
                        <p class="font-semibold text-lg">${{ $budget_left }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expense Table -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4">Expense History:</h2>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">Expense Name</th>
                        <th class="p-2">Amount</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr class="border-t">
                            <td class="p-2">{{ $expense->title }}</td>
                            <td class="p-2">${{ $expense->amount }}</td>
                            <td class="p-2">
                                <form method="POST" action="{{ route('delete-expense', $expense->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
