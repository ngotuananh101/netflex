<script>
import Checkbox from "../../../components/ArgonCheckbox.vue";

export default {
    name: 'Select Profile',
    components: {
        Checkbox
    },
    title() {
        return this.$t('profile.who_watching');
    },
    data() {
        return {
            profiles: [],
            avatar: [],
            status: 'loading',
            unsubscribe: null,
            addProfileModal: null,
            language: this.$root.language,
            profile: {
                avatar: '',
                name: '',
                is_kid: true
            }
        };
    },
    methods: {
        init() {
            let bootstrap = this.$store.state.config.bootstrap;
            this.addProfileModal = new bootstrap.Modal(document.getElementById('addProfile'));
            let imageList = this.$store.state.homeProfile.images;
            imageList.map((image) => {
                this.avatar.push('/storage/images/avatars/' + image);
            });
            // set random avatars when addProfileModal is shown
            this.addProfileModal._element.addEventListener('shown.bs.modal', () => {
                this.profile.avatar = this.avatar[Math.floor(Math.random() * this.avatar.length)];
            });
        },
        addProfile() {
            this.$store.dispatch('homeProfile/addProfile', this.profile);
        }
    },
    created() {
        this.unsubscribe = this.$store.subscribe((mutation, state) => {
            let payload = mutation.payload;
            switch (mutation.type) {
                case 'homeProfile/getProfileSuccess':
                    this.status = 'success';
                    this.profiles = payload.profiles;
                    this.init();
                    break;
                case 'homeProfile/addProfileSuccess':
                    this.profiles = payload;
                    this.addProfileModal.hide();
                    break;
                case 'homeProfile/error':
                    let message = '';
                    try {
                        message = payload.response.data.message;
                    } catch (e) {
                        message = payload.message;
                    }
                    this.$root.showSnackbar('danger', message);
                    break;
            }
        });
        this.$store.dispatch('homeProfile/getProfiles');
    },
    beforeUnmount() {
        this.unsubscribe();
    },
    computed: {
        profiles_size() {
            return Object.keys(this.profiles).length;
        }
    },
};
</script>

<template>
    <main id="select-profile">
        <div class="loading" v-if="status === 'loading'">
            <div class="loadingio-spinner-eclipse-5itokoxf6el">
                <div class="ldio-yf5d613p0g8">
                    <div></div>
                </div>
            </div>
        </div>
        <div class="w-100 h-100 d-flex flex-column justify-content-center align-items-center"
             v-else-if="status === 'success'">
            <h1 class="text-white fw-bold">{{ this.$t('profile.who_watching') }}</h1>
            <div class="container mx-md-5">
                <div id="profile-list" class="mt-3 row">
                    <div class="card p-3 col-md-2 col-5" v-for="profile in profiles">
                        <img class="card-img-top" :src="profile.avatar" alt="Card image cap">
                        <div class="card-body p-2">
                            <p class="card-title text-center fs-4 text-white opacity-5">{{ profile.name }}</p>
                        </div>
                    </div>
                    <div class="card p-3 col-md-2 col-5" v-if="profiles_size <= 4" @click="this.addProfileModal.show()">
                        <img class="card-img-top" src="../../../../../storage/app/public/images/avatars/add-profile.png" alt="Card image cap">
                        <div class="card-body p-2">
                            <p class="card-title text-center fs-4 text-white opacity-5">{{ this.$t('profile.add_profile') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <router-link :to="{ name: 'manage profile' }" id="manage-profile" class="btn mt-md-5 mt-3">
                {{ this.$t('profile.manage_profile') }}
            </router-link>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addProfile" tabindex="-1" aria-labelledby="addProfile" aria-hidden="true" v-if="profiles_size < 5">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-7 col-12">
                                    <h1 class="title fs-1">{{ this.$t('profile.add_profile') }}</h1>
                                    <p class="text-muted fs-5 mb-1">{{ this.$t('profile.add_description') }}</p>
                                    <hr class="mt-0">
                                    <div class="row justify-content-center align-items-center">
                                        <div class="col-md-3 col-12 pe-md-3 d-flex justify-content-center">
                                            <img class="img-fluid rounded-2" :src="profile.avatar"
                                                 alt="Card image cap">
                                        </div>
                                        <div class="col-md-6 col-12 mt-md-0 mt-3">
                                            <input type="text" class="profile-input" :placeholder="this.$t('profile.name')" maxlength="30" v-model="profile.name">
                                        </div>
                                        <div class="col-md-3 col-12 d-flex justify-content-center mt-md-0 mt-3">
                                            <div class="form-check custom-check d-flex align-items-center">
                                                <input
                                                    id="is_kid"
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="is_kid"
                                                    v-model="profile.is_kid"
                                                />
                                                <label for="is_kid" class="custom-control-label fw-normal text-white my-0 ms-1 fs-4">
                                                    {{ this.$t('profile.kid') }}?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="footer">
                                        <button type="button" class="btn btn-white fs-5 fw-normal me-3" @click="addProfile">{{ this.$t('profile.save') }}</button>
                                        <button type="button" class="btn btn-black fs-5 fw-normal"
                                                data-bs-dismiss="modal">{{ this.$t('profile.cancel') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<style scoped>
h1.title {
    font-weight: 600;
    margin-bottom: 0;
    color: white;
}

#select-profile {
    width: 100vw;
    height: 100vh;
}

#profile-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
}

#manage-profile {
    padding: 0.75rem 2.5rem;
    background: transparent;
    color: white;
    border: 1px solid white;
    border-radius: 0;
    font-size: 1rem;
    opacity: 0.5;

    &:hover {
        opacity: 1;
    }
}

#is_kid {
    background: #666 !important;
    color: white !important;
    border: 0;
    height: 2.75rem;
    width: 2.75rem;
    border-radius: 0;
    cursor: pointer;

    &:checked:after{
        font-size: 2.25rem;
    }
}

.card {
    background: transparent;
    border: none;
    padding: 0;
    cursor: pointer;
    box-shadow: none;

    .card-img-top {
        border-radius: 0.25rem;
    }

    &:hover {
        .card-img-top {
            border: 3px solid white;
        }

        .card-body {
            .card-title {
                opacity: 1;
            }
        }
    }
}

@media (min-width: 768px) {
    .card-body {
        .card-title {
            font-size: 1rem;
        }
    }

    &:hover {
        .card-img-top {
            border: 2px solid white;
        }
    }
}

</style>
