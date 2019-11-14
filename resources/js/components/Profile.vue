<template>
    <div class="profile">
        <div class="pic-and-link">
            <img v-if="avatarExists" class="avatar" :src="avatar" alt="avatar">
            <img v-else class="empty-avatar" :src="emptyAvatar" alt="empty-avatar"/>
            <a :href="profileUrl" class="username info-link" target="_blank">{{ userId }}</a>
        </div>
        <div class="user-info-container" v-if="_exists(user)">
            <span class="user-data-name">Display name</span><span class="user-data-value">{{ userDisplayName }}</span><br>
            <span class="user-data-name">Nickname</span><span class="user-data-value">{{ nickName }}</span><br>
            <span class="user-data-name">Followers</span><span class="user-data-value">{{ followerCount }}</span><br>
            <span class="user-data-name">Playlists</span><span class="user-data-value">{{ playlistCount }}</span><br>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    export default {
        name: 'profile',

        props: {
            user: {
                type: Object,
                required: true
            },
            emptyAvatar: String,
            followerCount: String,
            playlistCount: String
        },

        methods: {
            _exists(anything) {
                return !_.isNull(anything) && !_.isUndefined(anything) && !_.isEmpty(anything);
            }
        },

        mounted() {

        },

        computed: {
            userId() {
                return this.user.id;
            },

            userDisplayName() {
                return this.user.user.display_name;
            },

            nickName() {
                if (!_.isNull(this.user.nickname)) {
                    return this.user.nickname;
                } else {
                    return 'Not available'
                }
            },

            profileUrl() {
                return this.user.user.external_urls.spotify;
            },

            avatarExists() {
                return !_.isNull(this.avatar) && this.avatar !== '' && this.avatar !== null;
            },

            avatar() {
                return this.user.avatar;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .profile {
        .pic-and-link {
            width: 100%;
            height: 105px;
            margin-bottom: 50px;

            .username {
                float: left;
                line-height: 100px;
                margin-left: 20px;
            }

            .avatar {
                float: left;
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 50%;
            }

            .empty-avatar {
                float: left;
                width: 100px;
                height: 100px;
                object-fit: cover;
            }

            .info-link {
                color: $spotify-green;
                text-decoration: none;
            }
        }

        .user-info-container {
            font-size: 12px;
            text-align: left;
            line-height: 25px;
            margin-bottom: 100px;

            .user-data-name {
                font-weight: bold;
            }

            .user-data-value {
                float: right;
            }
        }
    }
</style>
