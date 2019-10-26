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

        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .card {
        border: none;
        border-radius: 7px;
        margin-bottom: 1rem;
    }

    .stats-card {
        background: $bg-light;

        .card-body {
            padding-top: 0;
            background: $bg-light;
            text-align: left;

            .card-title {
                font-size: 14px;
                font-weight: bold;
            }

            .card-text {
                font-size: 12px;
            }
        }

        .stat-heading {
            font-size: 80px;
        }
    }
</style>
