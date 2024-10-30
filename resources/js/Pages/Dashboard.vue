<script setup>

    import { ref, reactive } from "vue";
    import { Link, usePage } from "@inertiajs/vue3";

    // Get Current Locale
    const { locale } = usePage().props;
    const currentLocale = locale || 'en';

    // Get User Information
    const user = reactive(usePage().props.user);


    // Datos genéricos para prueba
    const userData = reactive({
        name: "John Doe",
        email: "johndoe@example.com",
        avatar: "https://i.pravatar.cc/150?img=3", // Avatar genérico
        purchases_count: 15,
        orders_count: 27,
    });

    const orderHistory = reactive([
        { id: 1, status: "Delivered", date: "2024-10-25" },
        { id: 2, status: "In Progress", date: "2024-10-27" },
        { id: 3, status: "Canceled", date: "2024-10-20" },
    ]);

</script>

<template>

    <div class="dashboard-container">
    <!-- Encabezado -->
    <header class="header">
      <img :src="userData.avatar" alt="User Avatar" class="avatar" />
      <div class="user-info">
        <h1>Welcome back, {{ userData.name }} 👋</h1>
        <p>{{ userData.email }}</p>
        <Link href="/" class="btn-home">Go to Home</Link>
      </div>
    </header>

    <!-- Estadísticas -->
    <div class="stats">
      <div class="stat-card">
        <h2>{{ userData.purchases_count }}</h2>
        <p>Total Purchases</p>
      </div>
      <div class="stat-card">
        <h2>{{ userData.orders_count }}</h2>
        <p>Total Orders</p>
      </div>
    </div>

    <!-- Historial de órdenes -->
    <section class="order-history">
      <h2>Your Recent Orders</h2>
      <ul class="order-list">
        <li v-for="order in orderHistory" :key="order.id" class="order-item">
          <p><strong>Order #{{ order.id }}</strong> - {{ order.status }}</p>
          <p>Placed on: {{ order.date }}</p>
        </li>
      </ul>
    </section>
  </div>

</template>

<style scoped>

    /* Mobile First Styles */
.dashboard-container {
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 24px;
  max-width: 600px;
  margin: auto;
}

/* Encabezado */
.header {
  display: flex;
  align-items: center;
  gap: 16px;
}

.avatar {
  width: 64px;
  height: 64px;
  border-radius: 50%;
  object-fit: cover;
}

.user-info h1 {
  font-size: 1.5rem;
  font-weight: bold;
}

.user-info p {
  color: #6b7280;
  margin-top: 4px;
}

.btn-home {
  margin-top: 8px;
  display: inline-block;
  padding: 8px 12px;
  background-color: #6366f1;
  color: white;
  text-decoration: none;
  border-radius: 8px;
  font-size: 0.9rem;
}

/* Sección de estadísticas */
.stats {
  display: flex;
  gap: 16px;
  justify-content: space-between;
}

.stat-card {
  flex: 1;
  background-color: #f3f4f6;
  border-radius: 8px;
  padding: 16px;
  text-align: center;
}

.stat-card h2 {
  font-size: 1.5rem;
  color: #111827;
  margin-bottom: 4px;
}

.stat-card p {
  color: #6b7280;
}

/* Historial de órdenes */
.order-history h2 {
  font-size: 1.25rem;
  margin-bottom: 8px;
}

.order-list {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

.order-item {
  background-color: #fff;
  padding: 12px;
  border-radius: 8px;
  margin-bottom: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.order-item p {
  margin: 0;
}

/* Responsive Design: Desktop */
@media (min-width: 768px) {
  .dashboard-container {
    max-width: 800px;
  }

  .header {
    gap: 24px;
  }

  .stats {
    gap: 32px;
  }

  .stat-card h2 {
    font-size: 2rem;
  }

  .order-history h2 {
    font-size: 1.5rem;
  }
}

</style>


