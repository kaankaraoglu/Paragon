<template>
    <div class="profile">
        <img v-if="avatarExists" class="avatar" :src="avatar" alt="avatar">
        <img v-else class="empty-avatar" :src="emptyAvatar" alt="empty-avatar"/>
        <a :href="profileUrl" class="username info-link" target="_blank">{{ userId }}</a>
    </div>
</template>

<script>
    export default {
        name: 'profile',
        props: {
            user: {
                type: Object,
                required: true
            },

            emptyAvatar: String
        },

        computed: {
            userId() {
                return this.user.id;
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
</style>
