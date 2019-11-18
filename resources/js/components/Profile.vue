<template>
    <div class="profile">
        <div class="pic-and-link">
            <img v-if="avatarExists" class="avatar" :src="avatar" alt="avatar">
            <img v-else class="empty-avatar" :src="emptyAvatar" alt="empty-avatar"/>
            <a :href="profileUrl" class="displayName info-link" target="_blank">{{ userDisplayName }}</a>
        </div>
        <div class="user-info-container" v-if="_exists(user)">
            <span class="user-data-name">Username</span><span class="user-data-value">{{ userId }}</span><br>
            <span class="user-data-name">Nickname</span><span class="user-data-value">{{ nickName }}</span><br>
            <span class="user-data-name">Followers</span><span class="user-data-value">{{ followerCount }}</span><br>
            <span class="user-data-name">Playlists</span><span class="user-data-value">{{ playlistCount }}</span><br><br><br>

            <div class="time-period-explanation" :data-tippy-content="timePeriodExplanation">Favourite Artists</div><br>
            <span class="user-data-name">Short-term </span><a :href="shortTermFavArtistLink" target="_blank">{{ shortTermFavArtistName }}</a><br>
            <span class="user-data-name">Medium-term </span><a :href="mediumTermFavArtistLink" target="_blank">{{ mediumTermFavArtistName }}</a><br>
            <span class="user-data-name">All-time </span><a :href="longTermFavArtistLink" target="_blank">{{ longTermFavArtistName }}</a><br><br><br>

            <div class="time-period-explanation" :data-tippy-content="timePeriodExplanation">Favourite Tracks</div><br>
            <span class="user-data-name">Short-term</span><a :href="shortTermFavTrackLink" target="_blank">{{ shortTermFavTrackName }}</a><br>
            <span class="user-data-name">Medium-term </span><a :href="mediumTermFavTrackLink" target="_blank">{{ mediumTermFavTrackName }}</a><br>
            <span class="user-data-name">All-time </span><a :href="longTermFavTrackLink" target="_blank">{{ longTermFavTrackName }}</a><br><br><br>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import tippy from 'tippy.js';
    import 'tippy.js/themes/material.css';
    import 'tippy.js/animations/scale-extreme.css';

    export default {
        name: 'profile',

        props: {
            user: Object,
            emptyAvatar: String,
            followerCount: String,
            playlistCount: String,
            favArtists: Object,
            favTracks: Object
        },

        methods: {
            _exists(anything) {
                return !_.isNull(anything) && !_.isUndefined(anything) && !_.isEmpty(anything);
            }
        },

        mounted() {
            tippy('.time-period-explanation', {
                theme: 'material',
                placement: 'top',
                animation: 'scale-extreme',
                inertia: true
            });
        },

        computed: {
            userId() {
                return this.user.id;
            },

            userDisplayName() {
                return this.user.user.display_name;
            },

            nickName() {
                return !_.isNull(this.user.nickname) ? this.user.nickname : 'Not available';
            },

            profileUrl() {
                return this.user.user.external_urls.spotify;
            },

            avatarExists() {
                return !_.isNull(this.avatar) && this.avatar !== '' && this.avatar !== null;
            },

            avatar() {
                return this.user.avatar;
            },

            shortTermFavArtistName: function () { return this.favArtists['short_term']['items'][0]['name']; },
            shortTermFavArtistLink: function () { return this.favArtists['short_term']['items'][0]['external_urls']['spotify']; },
            mediumTermFavArtistName: function () { return this.favArtists['medium_term']['items'][0]['name'] },
            mediumTermFavArtistLink: function () { return this.favArtists['medium_term']['items'][0]['external_urls']['spotify'] },
            longTermFavArtistName: function () { return this.favArtists['long_term']['items'][0]['name'] },
            longTermFavArtistLink: function () { return this.favArtists['long_term']['items'][0]['external_urls']['spotify']; },

            shortTermFavTrackName: function () { return this.favTracks['short_term']['items'][0]['name']; },
            shortTermFavTrackLink: function () { return this.favTracks['short_term']['items'][0]['external_urls']['spotify']; },
            mediumTermFavTrackName: function () { return this.favTracks['medium_term']['items'][0]['name'] },
            mediumTermFavTrackLink: function () { return this.favTracks['medium_term']['items'][0]['external_urls']['spotify'] },
            longTermFavTrackName: function () { return this.favTracks['long_term']['items'][0]['name'] },
            longTermFavTrackLink: function () { return this.favTracks['long_term']['items'][0]['external_urls']['spotify']; },

            timePeriodExplanation: function() {
                return '' +
                    '<p>Short-term: Approximately last 4 weeks.</p>' +
                    '<p>Medium-term: Approximately last 6 six months.</p>' +
                    '<p>All-time: Calculated from several years of data and including all new data as it becomes available.</p>';
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

            .displayName {
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

            .time-period-explanation {
                display: inline-block;
                margin-bottom: 15px;
            }

            .info-icon {
                color: $spotify-green;
                cursor: pointer;

                &:hover {
                    color: white;
                }
            }


            .user-data-name {
                font-weight: bold;
            }

            .user-data-value {
                float: right;
            }

            a {
                float: right;
                text-decoration: none;
            }
        }
    }
</style>
