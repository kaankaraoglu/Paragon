<template>
    <div class="home-page container-fluid">
        <img class="opus-1-logo" alt="opus-1-logo" :src="opusLogo">
        <p class="title">Opus 1</p>
        <p class="description">
            Opus 1 is a tool that displays detailed information about your Spotify playlists and
            generates new playlists based on genres and audio features such as BPM, danceability,
            instrumentalness and more. Enjoy! &#129304;
        </p>
        <a :href="loginRoute" class="spotify-button rounded-pill login-button">Login with Spotify</a>
        <a href="https://kaankaraoglu.com" class="about-me-link" target="_blank">About me &#9995;</a>
        <div class="privacy-warning" v-on:click="_showPrivacyModal">Privacy Information</div>
        <modal id="privacyModal" :modal-title="privacyModalTitle" :modal-body="privacyModalBody"></modal>
    </div>
</template>

<script>
    import Modal from "./Modal";
    export default {
        name: "home",
        components: {
            Modal
        },
        props: {
            loginRoute: String,
            opusLogo: String
        },
        data() {
            return {
                privacyModalTitle: 'Privacy Information',
                privacyModalBody: 'Opus doesn\'t save any of your data. The data fetched from Spotify is removed when you stop using the app and it is encrypted the whole time.'
            }
        },
        methods: {
            _showPrivacyModal() {
                $('#privacyModal').modal('show');
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .home-page {
        margin-top: 15vh;

        .opus-1-logo {
            height: 350px;
            margin-bottom: 50px;
            transform: translatey(0px);
            animation: float 5s ease-in-out infinite;
        }

        .title {
            font-size: 40px;
            font-weight: 100;
            letter-spacing: -2px;
            margin-bottom: 30px;
        }

        .description {
            width: 400px;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: justify;
            margin: 0 auto 40px;
        }

        .spotify-button {
            width: 170px;
            margin-bottom: 30px;
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

        .about-me-link {
            top: 50px;
            right: 50px;
            color: white;
            position: fixed;
            cursor: pointer;
            font-size: 10px;
            text-decoration: none;

            &:hover {
                cursor: pointer;
                color: $spotify-green;
            }
        }

        .privacy-warning {
            color: white;
            bottom: 15px;
            cursor: pointer;
            font-size: 10px;
            position: fixed;
        }
    }
</style>
