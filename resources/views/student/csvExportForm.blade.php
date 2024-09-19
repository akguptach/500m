<div>
    <form style="display: flex;" action="{{route('students.export')}}" method="POST" id="export_form">
        @csrf
        <div style="margin-right:5px;">
            <input name="from" class="date-range form-control" placeholder="Date From" readonly id="start_date"/>
            <div id="start_date_error" class="error"></div>
        </div>
        <div style="margin-right:5px;">
            <input name="to" class="date-range form-control" placeholder="Date To" readonly id="end_date"/>
            <div id="end_date_error" class="error" ></div>
        </div>
        <div>
            <button type="button" class="btn btn-success me-2"  id="submit_button">Export CSV</button>
        </div>
    </form>
</div>