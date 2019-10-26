<template>
    <div class="row header">
        <ul class="nav nav-pills nav-justified col-5" id="pills-tab" role="tablist">
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
        <div class="profile col-7">
            <img v-if="_avatarExists" class="avatar" :src="avatar" alt="avatar">
            <img v-else class="avatar" :src="'/assets/empty_avatar.png'" alt="avatar"/>
            <a :href="profileUrl" target="_blank" class="username info-link">{{ userId }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'dashboard-top-bar',
        props: {
            user: {
                type: Object,
                required: true
            }
        },

        computed: {
            userId() {
                return this.user.id;
            },

            profileUrl() {
                return this.user.user.external_urls.spotify;
            },

            avatar() {
                return this.user.avatar;
            }
        },

        methods: {
            _avatarExists() {
                return !_.isNull(this.avatar) && this.avatar !== '' && this.avatar !== null;
            }
        },

        mounted() {
            //console.log(this.user.avatar);
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .header {
        margin-bottom: 50px;

        .nav {
            width: 50%;

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

        .profile {
            width: 50%;

            .username {
                float: right;
                line-height: 50px;
                margin-right: 20px;
            }

            .avatar {
                float: right;
                width: 50px;
                height: 50px;
                object-fit: cover;
                border-radius: 50%;
            }
        }

        .info-link {
            color: $spotifyGreen;
            text-decoration: none;
        }

        .spotify-button {
            width: 150px;
            position: fixed;
            bottom: 15px;
            left: 15px;
        }
    }
</style>
