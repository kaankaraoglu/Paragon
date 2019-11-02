<template>
    <div class="profile">
        <img v-if="_avatarExists" class="avatar" :src="avatar" alt="avatar">
        <img v-else class="avatar" :src="'/assets/empty_avatar.png'" alt="avatar"/>
        <a :href="profileUrl" target="_blank" class="username info-link">{{ userId }}</a>
    </div>
</template>

<script>
    export default {
        name: 'profile',
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

        }
    }
</script>

<style lang="scss" scoped>
    @import '../../sass/variables';

    .profile {
        width: 100%;

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

        .info-link {
            color: $spotifyGreen;
            text-decoration: none;
        }
    }
</style>
