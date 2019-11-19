<template>
    <div class="home-page container-fluid">
        <img class="opus-1-logo" alt="opus-1-logo" :src="opusLogo">
        <p class="title">Opus 1</p>
        <p class="description">
            Opus 1 is a tool that displays interesting information about Spotify playlists, such as average audio features and statistics.
            It also generates playlists based on audio features such as BPM, danceability, instrumentalness, energy et cetera.
            Powered by Spotify API, Laravel and Vue. Enjoy!
        </p>
        <a :href="loginRoute" class="spotify-button rounded-pill login-button">Login with Spotify</a>
    </div>
</template>

<script>
    export default {
        name: "home",
        props: {
            loginRoute: String,
            opusLogo: String
        }
    }
</script>

<style lang="scss" scoped>
    .home-page {
        margin-top: 155px;

        .opus-1-logo {
            height: 350px;
            margin-bottom: 50px;
            transform: translatey(0px);
            animation: float 3s ease-in-out infinite;
        }

        .title {
            font-size: 40px;
            font-weight: 100;
            letter-spacing: -2px;
            margin-bottom: 30px;
        }

        .description {
            width: 400px;
            font-size: 0.8rem;
            font-weight: 500;
            text-align: justify;
            margin: 0 auto 40px;
        }

        .spotify-button {
            width: 170px;
        }

        @keyframes float {
            0% {
                transform: translatey(0px);
            }
            50% {
                transform: translatey(-15px);
            }
            100% {
                transform: translatey(0px);
            }
        }
    }
</style>
