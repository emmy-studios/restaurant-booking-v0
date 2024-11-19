<div class="emp_notification-container">

    @php
        $notification->is_read = true;
        $notification->update();
    @endphp

    <div class="emp_notification-header">
        <span id="type-badge">{{ $notification->notification_type }}</span>
        <p>{{ $notification->created_at }}</p>
    </div>

    <div class="emp_notification-content">
        <span>{{ $notification->title }}</span>
        <p>{{ $notification->message }}</p>
    </div>

</div>

<style>

    .emp_notification-container {
        background-color: #E7F0DC;
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 20px 20px;
        border-radius: 5px;
        color: black;
    }
    .emp_notification-header {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
    }
    .emp_notification-header #type-badge{
        padding: 3px 8px;
        font-size: 10px;
        color: #E55604;
        border: 1px solid #E55604;
        border-radius: 5px;
    }
    .emp_notification-header p {
        color: gray;
        font-size: 14px;
    }
    .emp_notification-content {
        margin-top: 20px;
        display: flex;
        flex-direction: column;
    }
    .emp_notification-content span {
        color: gray;
        font-weight: bold;
    }
    .emp_notification-content p {
        margin-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }

</style>
