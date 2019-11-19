<template>
    <div class="row dashboard-top-bar">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-public-playlists-tab" data-toggle="pill" href="#pills-public-playlists" role="tab" aria-controls="pills-public-playlists" aria-selected="true">Public Playlists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-private-playlists-tab" data-toggle="pill" href="#pills-private-playlists" role="tab" aria-controls="pills-private-playlists" aria-selected="false">Private Playlists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-generate-tab" data-toggle="pill" href="#pills-generate" role="tab" aria-controls="pills-generate" aria-selected="false">Generate</a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'dashboard-top-bar'
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .dashboard-top-bar {
        width: 100%;
        margin: 70px 0 40px;

        .nav {
            width: 100%;

            .nav-item {
                font-weight: bold;
                background: none;
                font-size: 0.8rem;

                .nav-link {
                    color: white !important;
                }

                .nav-link.active {
                    color: black !important;
                    font-weight: bold;
                    background: $spotify-green;
                }
            }
        }
    }
</style>
