<div class="mt-4">
    <select name="selectedYear" id="selectedYear" class="border">
        @foreach ($availableYears as $year)
             <option value="{{ $year }}">{{ $year }}</option>
        @endforeach
    </select>
    <canvas id="myChart"></canvas>
</div>
