<template>
    <div class="drawer">
        <a class="heading" :href="homeRoute">Opus 1</a>
        <profile
            :user="user"
            :empty-avatar="emptyAvatar"
            :follower-count="followerCount"
            :playlist-count="playlistCount"
            :fav-artists="favArtists"
            :fav-tracks="favTracks">
        </profile>
        <a class="logout-button spotify-button rounded-pill" :href="logoutRoute">Logout</a>
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
            logoutRoute: String,
            homeRoute: String,
            followerCount: String,
            playlistCount: String,
            favArtists: Object,
            favTracks: Object
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';
    @import '../../sass/mixins';

    .drawer {
        height: 100%;
        min-width: 400px;
        position: fixed;
        padding: 50px 45px;
        overflow: auto;

        &::-webkit-scrollbar {
            display: none;
        }

        .heading{
            width: 100%;
            float: left;
            color: white;
            font-size: 80px;
            text-align: left;
            font-weight: 600;
            margin-bottom: 45px;
            letter-spacing: -5px;
            text-decoration: none;

            &:hover {
                color: white;
            }
        }

        .logout-button {
            float: left;
            width: 100px;
        }
    }
</style>
