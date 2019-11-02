<template>
    <div class="row dashboard-side-bar">
        <ul class="nav nav-pills flex-column" id="pills-tab" role="tablist">
            <li class="nav-item">
                <profile :user="user"></profile>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="pills-stats-tab" data-toggle="pill" href="#pills-stats" role="tab" aria-controls="pills-stats" aria-selected="true">Stats</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-public-playlists-tab" data-toggle="pill" href="#pills-public-playlists" role="tab" aria-controls="pills-public-playlists" aria-selected="false">Public Playlists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-private-playlists-tab" data-toggle="pill" href="#pills-private-playlists" role="tab" aria-controls="pills-private-playlists" aria-selected="false">Private Playlists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Generate</a>
            </li>
        </ul>
    </div>
</template>

<script>
    import Profile from "./Profile";
    export default {
        name: 'dashboard-side-bar',
        components: {Profile},
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        mounted() {
            //console.log(this.user.avatar);
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .dashboard-side-bar {

        .nav {
            width: 100%;
            margin-right: 50px;

            .nav-item {
                background: none;

                .nav-link {
                    color: white;
                }

                .nav-link.active {
                    color: black;
                    font-weight: bold;
                    background: $spotifyGreen;
                }
            }
        }

        .spotify-button {
            width: 150px;
            position: fixed;
            bottom: 15px;
            left: 15px;
        }
    }
</style>
