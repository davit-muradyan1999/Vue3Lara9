<template>
    <li :class="wrapperClass" ref="dropdownRef" @click.stop>
        <button @click="toggleDropdown" type="button" class="button--plain menu-list__button">
            <template v-if="type === 'category'">
                <span>{{ $t('categories') }}</span>
            </template>
            <template v-else>
                <span>{{ $t('collections') }}</span>
            </template>
            <img v-if="!isOpen" class="icon chevron-down menu-list__button-icon down" src="/public/client/icons/arrow-down.svg" alt="arrow-down">
            <img v-else class="icon chevron-up menu-list__button-icon up" src="/public/client/icons/arrow-up.svg" alt="arrow-up">
        </button>
        <transition>
        <ul v-show="isOpen" class="menu-list__sub-list">
            <li class="menu-list__sub-list-item menu-list__sub-list-back-container">
                <button @click="closeDropdown" type="button" class="button--plain menu-list__sub-list-back">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 1024 1024" class="icon arrow-left menu-list__sub-list-back-icon">
                        <path class="icon__path"
                              d="M542.165 780.501l-225.835-225.835h494.336c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-494.336l225.835-225.835c16.683-16.683 16.683-43.691 0-60.331s-43.691-16.683-60.331 0l-298.667 298.667c-4.096 4.096-7.168 8.789-9.259 13.824-2.176 5.205-3.243 10.795-3.243 16.341 0 10.923 4.181 21.845 12.501 30.165l298.667 298.667c16.683 16.683 43.691 16.683 60.331 0s16.683-43.691 0-60.331z"></path>
                    </svg>
                    <template v-if="type === 'category'">
                        <span>{{ $t('categories') }}</span>
                    </template>
                    <template v-else>
                        <span>{{ $t('collections') }}</span>
                    </template>
                </button>
            </li>
            <li v-for="item in menuItems" :key="item.id" class="menu-list__sub-list-item">
                <template v-if="type === 'category'">
                    <Link class="link--plain menu-list__sub-list-link" :href="`/categories/${item.id}`" @click="closeDropdown">
                        {{ item.title[locale] }}
                    </Link>
                </template>
                <template v-else>
                    <Link class="link--plain menu-list__sub-list-link" :href="`/collections/${item.id}`" @click="closeDropdown">
                        {{ item.name[locale] }}
                    </Link>
                </template>
            </li>
        </ul>
        </transition>
    </li>
</template>

<script setup>
import { ref, onMounted, computed, onBeforeUnmount, nextTick } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    type: String,
});
const locale = computed(() => usePage().props.locale);
const isOpen = ref(false);
const menuItems = ref([]);
const dropdownRef = ref(null);

const closeDropdown = () => {
    isOpen.value = false;
};

const toggleDropdown = async () => {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        await nextTick();
    }
};

const handleClickOutside = (event) => {
    if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
        closeDropdown();
    }
};

onMounted(async () => {
    try {
        const response = await axios.get(props.type === 'category' ? '/api/categories' : '/api/collections');
        menuItems.value = response.data;
    } catch (error) {
        console.error('Error:', error);
    }

    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});

const wrapperClass = computed(() => ({
    'menu-list__item': true,
    'menu-list__sub-wrapper': true,
    'expand': isOpen.value,
}));
</script>

<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/shared.scss";

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}

.menu-list--metro {
    text-align: center;
    line-height: 0;
    font-size: 0;
    overflow: visible;
    white-space: nowrap;

    .menu-list__item {
        display: inline-block;
        margin: 0 1rem;
        overflow: visible;
        white-space: nowrap;
        position: relative;

        &:first-of-type {
            margin-left: 0;
        }

        &:last-of-type {
            margin-right: 0;
        }

        .menu-list__link,
        .menu-list__button span {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.125rem;
            height: 1rem;
            line-height: 1rem;
            color: colors.$charcoal300;
            transition: color 0.2s ease-in-out;

            &:hover {
                color: colors.$charcoal100;
            }
        }

        .menu-list__button {
            height: 1rem;
            position: relative;
            padding-right: 1rem;

            .menu-list__button-icon {
                position: absolute;
                height: 0.8rem;
                width: 0.8rem;
                top: 50%;
                transform: translateY(-50%);
                transition: opacity 0.2s ease-in-out;
                right: 0;

                &.up {
                    opacity: 0;
                }

                &.down {
                    opacity: 1;
                }

                path {
                    transition: fill 0.2s ease-in-out;
                    fill: colors.$charcoal300;
                }
            }

            &:hover {
                text-decoration: underline;
                .menu-list__button-icon {
                    path {
                        fill: colors.$charcoal100;
                    }
                }
            }
        }

        .menu-list__sub-list {
            position: absolute;
            left: -1rem;
            top: 1.5rem;
            min-width: 14rem;
            width: 100%;
            box-sizing: border-box;
            padding: 1.5rem;
            text-align: left;
            z-index: 10;
            border: 0.0625rem solid colors.$charcoal400;
            background-color: colors.$charcoal600;
            border-radius: 0.5rem;
            opacity: 0;
            visibility: hidden;
            clip-path: inset(0 0 100% 0);
            transition: visibility 0s linear 0.3s, clip-path 0.3s ease-in-out, opacity 0.3s ease-in-out;

            .menu-list__sub-list-item {
                margin-bottom: 0.5rem;
                &:last-of-type {
                    margin-bottom: 0;
                }
                .menu-list__sub-list-link {
                    font-size: 1rem;
                    line-height: 2rem;
                    display: block;
                    text-transform: capitalize;
                    color: colors.$charcoal300;
                    transition: color 0.2s ease-in-out;

                    &:hover {
                        color: colors.$charcoal100;
                    }
                }
            }
        }

        &.expand {
            .menu-list__button {
                span {
                    color: colors.$charcoal100;
                }
                text-decoration: underline;

                .menu-list__button-icon {
                    path {
                        fill: colors.$charcoal100;
                    }
                    &.up {
                        opacity: 1;
                    }

                    &.down {
                        opacity: 0;
                    }
                }
            }

            .menu-list__sub-list {
                opacity: 1;
                visibility: visible;
                clip-path: inset(0 0 0 0);
                transition: visibility 0s linear, clip-path 0.3s ease-in-out, opacity 0.3s ease-in-out;
            }
        }
    }
}

.menu-list--stack {
    overflow: hidden;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 10;

    .menu-list__link,
    .menu-list__sub-list-link,
    .menu-list__button {
        box-sizing: border-box;
        display: block;
        width: 100%;
        font-weight: 500;
        letter-spacing: 0.0625rem;
        font-size: 1rem;
        height: 3rem;
        line-height: 3rem;
        padding: 0 1.5rem;
        text-align: left;
        transition: background-color 0.3s ease-in-out;

        &:hover {
            background-color: colors.$charcoal500;
        }
    }

    .menu-list__item {
        .menu-list__button {
            position: relative;

            .menu-list__button-icon {
                position: absolute;
                top: 50%;
                right: 1.5rem;
                transform: translateY(-50%);
                height: 1rem;
                width: 1rem;

                path {
                    fill: colors.$charcoal200;
                }
            }
        }
    }

    .menu-list__sub-wrapper {
        .menu-list__sub-list {
            background-color: colors.$charcoal600;
            position: absolute;
            z-index: 10;
            top: 0;
            left: 0;
            bottom: 0;
            width: 100%;
            transform: translateX(100%);
            opacity: 0;
            visibility: hidden;
            transition: visibility 0s linear 0.3s, transform 0.3s ease-in-out, opacity 0.3s ease-in-out;

            .menu-list__sub-list-item {
                .menu-list__sub-list-back {
                    padding: 0 1.5rem 0 3rem;
                    text-align: left;
                    position: relative;
                    width: 100%;
                    background-color: colors.$charcoal500;
                    height: 2rem;
                    box-sizing: border-box;
                    margin: 0;
                    overflow: hidden;
                    border-bottom: 0.0625rem solid colors.$charcoal600;

                    span {
                        display: block;
                        width: 100%;
                        height: 2rem;
                        line-height: 2rem;
                    }

                    .menu-list__sub-list-back-icon {
                        position: absolute;
                        left: 1.5rem;
                        height: 1rem;
                        width: 1rem;
                        top: 50%;
                        transform: translateY(-50%);
                    }
                }
            }
        }

        &.expand {
            .menu-list__sub-list {
                transform: translateX(0);
                visibility: visible;
                opacity: 1;
                transition: visibility 0s linear, transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            }
        }
    }
}

@media (min-width: 1176px) {
    .menu-list__sub-list-back-container {
        display: none;
    }
}
</style>
