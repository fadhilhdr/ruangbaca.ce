<x-app-layout>
    <h1>Pay Fine</h1>
    <p>Fine Amount: {{ $fine->amount }}</p>
    <form method="POST" action="{{ route('fines.pay') }}">
        @csrf
        <input type="hidden" name="book_loan_id" value="{{ $fine->book_loan_id }}">
        <button type="submit">Pay Fine</button>
    </form>
</x-app-layout>