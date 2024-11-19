<div class="emp_task-main-container">

    @php
        $employeeTask->is_read = true;
        $employeeTask->update();
    @endphp

    <div class="emp_task-container">
        <div class="emp_task-header">

            @if($employeeTask->status === "Pending")
                <span id="emp_pending-task">{{ $employeeTask->status }}</span>
            @elseif($employeeTask->status === "Completed")
                <span id="emp_completed-status">{{ $employeeTask->status }}</span>
            @else
                <p></p>
            @endif

            <p>{{ $employeeTask->task_name }}</p>
        </div>
        <span id="emp_due-date">
            {{ __('models.due_date') }}: {{ $employeeTask->due_date }}
        </span>
        <div class="emp_task-description">
            <p>{{ $employeeTask->description }}</p>
        </div>
    </div>

    @if($employeeTask->additional_details)
        <div class="emp_additional-details">
            <span>{{ __('models.additional_details') }}</span>
            <p>{{ $employeeTask->additional_details }}</p>
        </div>
    @endif

</div>

<style>

    .emp_task-main-container {
        display: flex;
        flex-direction: column;
    }
    .emp_task-container {
        display: flex;
        flex-direction: column;
        padding: 20px 20px;
        border-radius: 5px;
        border: 1px solid orange;
        background-color: #fff;
    }
    .emp_task-header {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
    }
    #emp_pending-task {
        padding: 3px 4px;
        border: 1px solid #CB9DF0;
        border-radius: 5px;
        font-size: 10px;
        color: #CB9DF0;
    }
    .emp_task-header p {
        /*color: #697565;*/
        color: purple;
    }
    #emp_due-date {
        color: #FF2929;
        /*padding-top: 6px;
        padding-bottom: 6px;*/
        padding: 10px 6px;
        font-size: 14px;
    }
    .emp_task-description {
        display: flex;
    }
    .emp_task-description p {
        padding: 10px 10px;
        color: #181C14;
    }
    .emp_additional-details {
        display: flex;
        flex-direction: column;
        margin-top: 15px;
        padding: 20px 20px;
        border-radius: 5px;
        border: 1px solid orange;
        background-color: #fff;
    }
    .emp_additional-details span {
        font-weight: bold;
        padding-bottom: 10px;
        color: #343131;
    }
    .emp_additional-details p {
        color: #181C14;
        padding: 10px 10px;
    }

</style>
