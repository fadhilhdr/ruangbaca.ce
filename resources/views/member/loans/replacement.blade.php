<x-app-layout>
    <h1>Lost Book Replacement</h1>
    <form method="POST" action="{{ route('loans.book-replacement', $loan->id) }}">
        @csrf
        <label for="replacement">Replacement or Fine Payment</label>
        <input type="text" name="replacement" id="replacement">
        <button type="submit">Submit</button>
    </form>
</x-app-layout>
