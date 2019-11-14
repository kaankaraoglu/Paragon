<template>
    <div class="drawer">
        <div class="fixed">
            <h1 class="heading">Dashboard</h1>
            <profile :user="user" :empty-avatar="emptyAvatar"></profile>
            <a class="logout-button spotify-button fixed" :href="logoutRoute">Logout</a>
        </div>
    </div>
</template>

<script>
    import Profile from "./Profile";

    export default {
        name: 'drawer',
        components: {
            Profile
        },
        props: {
            user: Object,
            emptyAvatar: String,
            logoutRoute: String
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .drawer {
        padding: 50px 0 0 50px;

        .heading{
            width: 100%;
            font-size: 60px;
            text-align: left;
            font-weight: 100;
            margin-bottom: 100px;
            letter-spacing: -6px;
        }

        .logout-button {
            bottom: 50px;
            left: 50px;
            width: 100px !important;
        }

        .fixed {
            position: fixed;
        }
    }
</style>
