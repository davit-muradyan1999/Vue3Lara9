<template>
    <div>
        <h1 v-if="private">{{ $t('product_private') }}</h1>
        <h1 v-else-if="category">{{ $t('product_category') }} {{ category.title[locale] }}</h1>
        <h1 v-else-if="collection">{{ $t('product_category') }} {{ collection.name[locale] }}</h1>
        <div class="filters flex items-center justify-between mb-6 w-full flex-wrap gap-4">
            <div class="flex items-center justify-self-start gap-4">
                <p>{{ $t('filter') }}</p>
                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <select v-model="availabilityFilter"
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                            <option value="">{{ $t('availability') }}</option>
                            <option value="in_stock">{{ $t('in_stock') }}</option>
                            <option value="out_of_stock">{{ $t('out_stock') }}</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                             stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-self-start gap-4">
                <p class="w-full">{{ $t('sort_by') }}</p>
                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <select v-model="sortFilter"
                            class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                            <option disabled>&nbsp;</option>
                            <option value="best">{{ $t('best_selling') }}</option>
                            <option value="a_z">{{ $t('a_z') }}</option>
                            <option value="z_a">{{ $t('z_a') }}</option>
                            <option value="price_low">{{ $t('low_high') }}</option>
                            <option value="price_high">{{ $t('high_low') }}</option>
                            <option value="desc">{{ $t('new_old') }}</option>
                            <option value="asc">{{ $t('old_new') }}</option>
                        </select>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                             stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="paginator list-product__products--three-column">
            <div class="paginator__wrapper">
                <Link v-for="product in products" :key="product.id" :href="'/product/'+product.id" class="link-product--imageExpandOnHover list-product__products__item">
                    <span class="link-product__image-wrapper">
                        <img class="link-product__image" :src="product.images.length ? `/storage/${product.images[0]}` : 'https:\\/\\/via.placeholder.com\\/200'" :alt="product.title">
                    </span>
                    <span class="link-product__title">{{ product.title[locale] }}</span>
                    <span class="text-price link-product__price">
                        <span>{{ product.price }}$</span>
                    </span>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, ref, watch} from "vue";
import {Link, router, usePage} from "@inertiajs/vue3";

const locale = computed(() => usePage().props.locale);
const props = defineProps({
    private: Boolean,
    category: Object,
    collection: Object,
    products: Array
});
console.log(props.products, "products");
const availabilityFilter = ref("");
const sortFilter = ref("best");
const path = props.category?.id
    ? `/categories/${props.category.id}`
    : `/collections/${props.collection.id}`;
watch([availabilityFilter, sortFilter], () => {
    if (props.private) {
        router.get("/private-club", {
            availability: availabilityFilter.value,
            sort: sortFilter.value,
        }, { preserveState: true, replace: true });
    } else {
        router.get(path, {
            availability: availabilityFilter.value,
            sort: sortFilter.value,
        }, { preserveState: true, replace: true });
    }
});
</script>
<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/typography.scss";
@use "../../../../assets/styles/shared.scss";
.filters {
    margin-bottom: 1.5rem;
}
.list-product__products {
    .paginator__wrapper {
        display: flex;
        gap: 1.5rem;
        flex-flow: row wrap;
        justify-content: flex-start;
        align-items: stretch;
    }
}

.list-product__products__item {
    width: calc((100% - 4.5rem) / 4);
    overflow: hidden;

    @media (max-width: 900px) {
        width: calc((100% - 3rem) / 3);
    }

    @media (max-width: 750px) {
        width: calc((100% - 1.5rem) / 2);
    }

    @media (max-width: 500px) {
        width: 100%;
    }
}

.list-product__products--three-column {
    @extend .list-product__products;

    .list-product__products__item {
        width: calc((100% - 3rem) / 3);
        overflow: hidden;

        @media (max-width: 750px) {
            width: calc((100% - 1.5rem) / 2);
        }

        @media (max-width: 500px) {
            width: 100%;
        }
    }
}

.link-product {
    overflow: hidden;
    display: block;
    box-sizing: border-box;
    border: 0.0625rem solid colors.$charcoal500;
    border-radius: 0.5rem;

    &:hover {
        .link-product__title {
            text-decoration: underline;
        }
    }
}

.link-product__image-wrapper {
    display: block;
    width: 100%;
    padding-bottom: calc(100% * 4 / 3);
    overflow: hidden;
    position: relative;
}

.link-product__image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;

    &:nth-of-type(2n + 1) {
        z-index: 2;
    }

    &:nth-of-type(2n + 2) {
        z-index: 1;
    }
}

.link-product__tag {
    position: absolute;
    z-index: 3;
    bottom: 1rem;
    left: 1rem;
    height: 1.5rem;
    line-height: 1.5rem;
    padding: 0.125rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    color: colors.$charcoal500;
    background-color: colors.$charcoal200;
}

.link-product__sale-tag {
    @extend .link-product__tag;
}

.link-product__sold-out-tag {
    @extend .link-product__tag;
    background-color: colors.$charcoal100;
    color: white;
}

.link-product__title {
    display: block;
    font-family: typography.$heading;
    font-size: 0.875rem;
    letter-spacing: 0.0625rem;
    padding: 1rem 1.5rem 0.5rem 1.5rem;
}

.link-product__price {
    display: block;
    padding: 0.5rem 1.5rem 1rem 1.5rem;
}

.link-product--imageExpandOnHover {
    @extend .link-product;

    .link-product__image {
        transition: transform 0.5s ease-in-out;
    }

    &:hover {
        .link-product__image {
            transform: scale(1.05);
        }
    }
}


</style>
