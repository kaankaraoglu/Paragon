<template>
    <div class="card stats-card">
        <span class="stat-heading">{{ cardData }}</span>
        <div class="card-body">
            <h5 class="card-title">{{ cardTitle }}</h5>
            <p class="card-text">{{ cardText }}</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'stat-card',
        props: {
            cardData: String,
            cardTitle: String,
            cardText: String
        },
        mounted() {
            //console.log('Mounted');
        }
    }
</script>
