<template>
    <div class="drawer">
        <h1 class="heading">Dashboard</h1>
        <profile :user="user" :empty-avatar="emptyAvatar"></profile>
        <a class="logout-button spotify-button" :href="logoutRoute">Logout</a>
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
        margin-top: 50px;
        padding-left: 30px;

        .heading{
            width: 100%;
            font-size: 60px;
            text-align: left;
            font-weight: 100;
            margin-bottom: 100px;
            letter-spacing: -6px;
        }

        .logout-button {
            width: 50%;
            float: left;
            margin-top: 30px;
        }
    }
</style>
