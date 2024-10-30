<script setup>

</script>

<template>

    <div class="teams-container">

        <header class="header">
            <h1>Are you a member of our team?</h1>
            <p>Select our role and get access to your designated panel based on your role.</p>
        </header>

        <div class="profiles-grid">

            <div class="profile-card">
                <div class="profile-icon">🔧</div>
                <a href="/admin/login" class="link-item">Admin</a>
            </div>

            <div class="profile-card">
                <div class="profile-icon">👨‍🍳</div>
                <a href="/chef/login" class="link-item">Chef</a>
            </div>

            <div class="profile-card">
                <div class="profile-icon">👔</div>
                <a href="/employee/login" class="link-item">Employee</a>
            </div>

            <div class="profile-card">
                <div class="profile-icon">📊</div>
                <a href="/manager/login" class="link-item">Manager</a>
            </div>

        </div>

    </div>

</template>

<style scoped>

    /* Main Container */
    .teams-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 16px;
        min-height: 100vh;
        background-color: #f9fafb;
        gap: 24px;
    }

    /* Header */
    .header h1 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #111827;
        text-align: center;
    }

    .header p {
        color: #6b7280;
        font-size: 1rem;
        margin-top: 4px;
        text-align: center;
    }

    /* Grid Container */
    .profiles-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        width: 100%;
        max-width: 400px;
    }

    /* Role Card */
    .profile-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: pointer;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .profile-icon {
        font-size: 3rem;
        margin-bottom: 12px;
    }

    /*.profile-card h2 {
        font-size: 1.2rem;
        font-weight: bold;
        color: #374151;
        text-align: center;
    }*/

    .link-item {
        font-size: 1.2rem;
        font-weight: bold;
        color: #374151;
        text-align: center;
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .profiles-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }
    }

    @media (min-width: 1024px) {
        .teams-container {
            padding: 32px;
        }

        .profiles-grid {
            max-width: 800px;
            grid-template-columns: repeat(4, 1fr);
        }

        .profile-card {
            padding: 24px;
        }
    }

</style>
