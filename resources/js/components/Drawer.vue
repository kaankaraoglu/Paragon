<template>
    <div class="drawer">
        <div class="col-lg-2 fixed">
            <h1 class="heading">Opus 1</h1>
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
            followerCount: String,
            playlistCount: String,
            favArtists: Object,
            favTracks: Object
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .drawer {
        padding: 0;

        .fixed {
            padding: 50px 50px;
            position: fixed;

            .heading{
                width: 100%;
                font-size: 80px;
                text-align: left;
                font-weight: 100;
                margin-bottom: 45px;
                letter-spacing: -6px;
            }

            .logout-button {
                float: left;
                width: 100px !important;
            }
        }
    }
</style>
