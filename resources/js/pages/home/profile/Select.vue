<script>
export default {
    name: 'Select Profile',
    components: {},
    title() {
        return this.$t('profile.who_watching');
    },
    data() {
        return {
            profiles: [],
            status: 'loading',
            unsubscribe: null,
            addProfileModal: null,
            language: this.$root.language
        };
    },
    methods: {
        init() {
            console.log('init');
            let bootstrap = this.$store.state.config.bootstrap;
            console.log(bootstrap)
            this.addProfileModal = new bootstrap.Modal(document.getElementById('addProfile'));
        }
    },
    created() {
        this.unsubscribe = this.$store.subscribe((mutation, state) => {
            let payload = mutation.payload;
            switch (mutation.type) {
                case 'homeProfile/getProfileSuccess':
                    this.status = 'success';
                    this.profiles = payload;
                    this.init();
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
                        <img class="card-img-top" src="https://picsum.photos/200/200" alt="Card image cap">
                        <div class="card-body p-2">
                            <p class="card-title text-center">Card title</p>
                        </div>
                    </div>
                    <div class="card p-3 col-md-2 col-5" v-if="profiles_size < 5" @click="this.addProfileModal.show()">
                        <img class="card-img-top" src="../../../assets/img/avatar/add-profile.png" alt="Card image cap">
                        <div class="card-body p-2">
                            <p class="card-title text-center">{{ this.$t('profile.add_profile') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <router-link :to="{ name: 'manage profile' }" id="manage-profile" class="btn mt-md-5 mt-3">
                {{ this.$t('profile.manage_profile') }}
            </router-link>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addProfile" tabindex="-1" aria-labelledby="addProfile" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-7 col-12">
                                    <h1 class="title">Add Profile</h1>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-md-3 col-12 image pe-md-3">
                                            <div class="edit-icon">
                                                <i class='fa-light fa-pen'></i>
                                            </div>
                                            <img class="card-img-top" src="https://picsum.photos/200/200"
                                                 alt="Card image cap">
                                        </div>
                                        <div class="col-md-9 col-12">
                                            <input type="text" class="profile-input" placeholder="Name" maxlength="30">
                                            <p class="text-m opacity-7 fs-5 mt-md-4">Language:</p>
                                            <select
                                                class="text-white profile-select"
                                                name="choices-language"
                                                style="max-height: 100%;"
                                                v-model="language"
                                            >
                                                <option value="vi" data-select-text="Tiếng Việt">Tiếng Việt</option>
                                                <option value="en" data-select-text="English">English</option>
                                            </select>
                                            <p class="opacity-7 fs-5 mt-md-4">Game Handle:</p>
                                            <span class="fs-6 mt-md-4">Your handle is a unique name that'll be used  for playing with other Netflix members across all Netflix Games.</span>
                                            <input type="text" class="profile-input mt-md-2" placeholder="Create Game Handle" maxlength="15">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="footer">
                                        <button type="button" class="btn btn-white fs-5 fw-normal me-3">Save</button>
                                        <button type="button" class="btn btn-black fs-5 fw-normal"
                                                data-bs-dismiss="modal">Cancel
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
    font-size: 4.5rem;
    font-weight: 500;
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

.image {
    position: relative;
    .edit-icon {
        position: absolute;
        top: 85%;
        left: 20%;
        transform: translate(-50%, -50%);
        z-index: 2;
        color: white;
        font-size: 1rem;
        background-color: black;
        padding: 3px;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-img-top {
        border-radius: 0.25rem;
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

    .card-body {
        .card-title {
            font-size: 1.5rem;
            color: white;
            opacity: 0.5;
        }
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
