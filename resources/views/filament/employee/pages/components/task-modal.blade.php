<div class="emp_task-main-container">

    @php
        $employeeTask->is_read = true;
        $employeeTask->update();
    @endphp

    <div class="emp_task-container">

        <div class="emp_task-icon">
            <img src="{{ asset('assets/images/panels/task_icon.png') }}" />
        </div>

        <div class="emp_task-header">
            <p>{{ $employeeTask->task_name }}</p>
            @if($employeeTask->status === "In Progress")
                <span id="emp_inprogress-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Pending")
                <span id="emp_pending-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Cancelled")
                <span id="emp_cancelled-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Completed")
                <span id="emp_completed-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Reviewed")
                <span id="emp_reviewed-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Approved")
                <span id="emp_approved-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Review Pending")
                <span id="emp_reviewpending-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Unfinished")
                <span id="emp_unfinished-task">{{ $employeeTask->status }}</span>
            @else
                <p></p>
            @endif
        </div>

        <span id="emp_due-date">
            Fecha Límite: {{ $employeeTask->due_date }}
        </span>

        <div class="emp_task-description">
            <p>{{ $employeeTask->description }}</p>
        </div>

        @if($employeeTask->additional_details)
            <div class="emp_additional-details">
                <h3>{{ __('models.additional_details') }}</h3>
                <p>{{ $employeeTask->additional_details }}</p>
            </div>
        @endif

        @if($employeeTask->supervisor_comment)
            <div class="emp_supervisor-comment">
                <h3>{{ __('models.supervisor_comment') }}</h3>
                <h4>{{ __('models.supervised_by') }}: <span>{{ $employeeTask->supervisor->name }}</span></h4>
                <p>{{ $employeeTask->supervisor_comment }}</p>
            </div>
        @endif

        @if($employeeTask->employee_notes)
            <div class="emp_employee-notes">
                <h3>{{ __('models.employee_notes') }}</h3>
                <p>{{ $employeeTask->employee_notes }}</p>
            </div>
        @endif

    </div>

</div>

<style>

    .emp_task-main-container {
        display: flex;
        flex-direction: column;
    }
    .emp_task-container {
        display: flex;
        flex-direction: column;
        padding: 25px 25px;
        border-radius: 20px;
        /*border: 1px solid #F3D0D7;*/
        background-color: #e9edc9;
        /*background-color: white;*/
    }
    .emp_task-icon {
        padding: 60px 10px;
        display: flex;
        justify-content: center;
    }
    .emp_task-icon img {
        height: 40%;
        width: 40%;
    }
    .emp_task-header {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    .emp_additional-details {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding-top: 20px;
    }
    .emp_additional-details h3 {
        font-weight: bold;
        color: #403d39;
    }
    .emp_additional-details p {
        /*border: 1px groove gray;*/
        border-radius: 5px;
        background-color: #ccd5ae;
        padding: 20px 20px;
        color: #161a1d;
    }
    .emp_supervisor-comment {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        border: 1px dotted #386641;
        border-radius: 5px;
        padding: 20px 20px;
    }
    .emp_supervisor-comment h3 {
        font-weight: bold;
        color: #403d39;
    }
    .emp_supervisor-comment h4 {
        font-size: 12px;
        color: #403d39;
    }
    .emp_supervisor-comment span {
        font-size: 14px;
        padding: 4px 3px;
        border: 1px solid #ef8354;
        border-radius: 5px;
        background-color: #ef8354;
        color: white;
    }
    .emp_supervisor-comment p {
        color: #161a1d;
    }
    .emp_employee-notes {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        border: 1px dotted #386641;
        border-radius: 5px;
        padding: 20px 20px;
    }
    .emp_employee-notes h3 {
        font-weight: bold;
        color: #403d39;
    }
    .emp_employee-notes p {
        color: #161a1d;
    }
    #emp_pending-task {
        padding: 3px 4px;
        border: 1px solid #fb8159;
        border-radius: 5px;
        font-size: 10px;
        background-color: #fb8159;
        color: white;
    }
    #emp_inprogress-task {
        padding: 3px 4px;
        border: 1px solid #88a2ff;
        border-radius: 5px;
        font-size: 10px;
        background-color: #88a2ff;
        color: white;
    }
    /*#emp_completed-task {
        padding: 3px 4px;
        border: 1px solid green;
        border-radius: 5px;
        font-size: 10px;
        background-color: green;
        color: white;
    }*/
    #emp_unfinished-task {
        padding: 3px 4px;
        border: 1px solid #ffafcc;
        border-radius: 5px;
        font-size: 10px;
        background-color: #ffafcc;
        color: white;
    }
    #emp_cancelled-task {
        padding: 3px 4px;
        border: 1px solid red;
        border-radius: 5px;
        font-size: 10px;
        background-color: #EE4B2B;
        color: white;
    }
    #emp_completed-task {
        padding: 3px 4px;
        border: 1px solid #64ce5a;
        border-radius: 5px;
        font-size: 10px;
        background-color: #64ce5a;
        color: white;
    }
    #emp_reviewed-task {
        padding: 3px 4px;
        border: 1px solid #25a244;
        border-radius: 5px;
        font-size: 10px;
        background-color: #25a244;
        color: white;
    }
    #emp_approved-task {
        padding: 3px 4px;
        border: 1px solid #add1a8;
        border-radius: 5px;
        font-size: 10px;
        background-color: #add1a8;
        color: white;
    }
    #emp_reviewpending-task {
        padding: 3px 4px;
        border: 1px solid #d35ba5;
        border-radius: 5px;
        font-size: 10px;
        background-color: #d35ba5;
        color: white;
    }
    .emp_task-header p {
        color: #0b090a;
        font-weight: bold;
    }
    #emp_due-date {
        color: #ef233c;
        padding: 10px 6px;
        font-size: 14px;
    }
    .emp_task-description {
        display: flex;
        padding: 20px 20px;
        background-color: #ccd5ae;
        border-radius: 5px;
        /*border: 1px groove gray;*/
    }
    .emp_task-description p {
        padding: 10px 10px;
        color: #161a1d;
    }

</style>
