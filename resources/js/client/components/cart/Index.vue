<template>
    <div class="cart-template__header"><h1 class="text-heading-1 cart-template__header__heading">Your cart</h1>
    </div>
    <div class="cart-template__table-wrapper">
        <table class="cart-template__table">
            <thead class="cart-template__table__header">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody v-if="items.length" class="cart-template__table__body">
            <tr v-for="item in items" :key="item.id" class="cart-template__table__body__row">
                <td class="cart-template__table__body__row__image-link-price">
                    <img class="cart-template__table__body__row__image-link-price__image"
                    :src="`/storage/${item.product.images[0]}`" alt="product">
                    <div>
                    <a class="link--underlineOnHover cart-template__table__body__row__image-link-price__link"
                            href="/react-based-shopify-craft-theme/products/the-tall-glasses">{{ item.product.title[locale] }}</a><span
                        class="text-price cart-template__table__body__row__image-link-price__price"><span>{{ item.product.price }}</span></span>
                    </div>
                </td>
                <td class="cart-template__table__body__row__quantity">
                    <div class="button-quantity  cart-template__table__body__row__quantity__button">
                        <button type="button"
                                class="button--plain  button-icon--expandOnHover disable button-quantity__minus">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 1024 1024" class="icon minus button-icon__icon">
                                <path class="icon__path"
                                      d="M213.333 554.667h597.333c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-597.333c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"></path>
                            </svg>
                        </button>
                        <span class="button-quantity__quantity">{{ item.quantity }}</span>
                        <button type="button" class="button--plain  button-icon--expandOnHover  button-quantity__plus">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                 viewBox="0 0 1024 1024" class="icon plus button-icon__icon">
                                <path class="icon__path"
                                      d="M213.333 554.667h256v256c0 23.552 19.115 42.667 42.667 42.667s42.667-19.115 42.667-42.667v-256h256c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667h-256v-256c0-23.552-19.115-42.667-42.667-42.667s-42.667 19.115-42.667 42.667v256h-256c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667z"></path>
                            </svg>
                        </button>
                    </div>
                    <button type="button" @click="removeItem(item.id)"
                            class="button--plain  button-icon--expandOnHover  cart-template__table__body__row__quantity__remove">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 1024 1024" class="icon trash button-icon__icon">
                            <path class="icon__path"
                                  d="M768 298.667v554.667c0 11.776-4.736 22.4-12.501 30.165s-18.389 12.501-30.165 12.501h-426.667c-11.776 0-22.4-4.736-30.165-12.501s-12.501-18.389-12.501-30.165v-554.667zM725.333 213.333v-42.667c0-35.328-14.379-67.413-37.504-90.496s-55.168-37.504-90.496-37.504h-170.667c-35.328 0-67.413 14.379-90.496 37.504s-37.504 55.168-37.504 90.496v42.667h-170.667c-23.552 0-42.667 19.115-42.667 42.667s19.115 42.667 42.667 42.667h42.667v554.667c0 35.328 14.379 67.413 37.504 90.496s55.168 37.504 90.496 37.504h426.667c35.328 0 67.413-14.379 90.496-37.504s37.504-55.168 37.504-90.496v-554.667h42.667c23.552 0 42.667-19.115 42.667-42.667s-19.115-42.667-42.667-42.667zM384 213.333v-42.667c0-11.776 4.736-22.4 12.501-30.165s18.389-12.501 30.165-12.501h170.667c11.776 0 22.4 4.736 30.165 12.501s12.501 18.389 12.501 30.165v42.667zM384 469.333v256c0 23.552 19.115 42.667 42.667 42.667s42.667-19.115 42.667-42.667v-256c0-23.552-19.115-42.667-42.667-42.667s-42.667 19.115-42.667 42.667zM554.667 469.333v256c0 23.552 19.115 42.667 42.667 42.667s42.667-19.115 42.667-42.667v-256c0-23.552-19.115-42.667-42.667-42.667s-42.667 19.115-42.667 42.667z"></path>
                        </svg>
                    </button>
                </td>
                <td class="cart-template__table__body__row__total"><span
                    class="text-price cart-template__table__body__row__total__text"><span>{{ (item.product.price * item.quantity).toFixed(2) }}</span>
</span></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="cart-template__subtotal">
        <div><h4 class="text-heading-4 cart-template__subtotal__heading">Subtotal</h4><span
            class="text-price cart-template__subtotal__price"><span>{{ subtotal }}</span></span></div>
        <button
            @click="checkout"
            class="link--button cart-template__subtotal__check-out-row__button">
            Check out
        </button>
    </div>
</template>

<script setup>
import { router, usePage, Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    items: Array
})
const locale = computed(() => usePage().props.locale)

const removeItem = (id) => {
    router.post(route('cart.remove'), { id }, { preserveScroll: true })
}
const subtotal = computed(() =>
    props.items.reduce((acc, item) => acc + item.quantity * item.product.price, 0).toFixed(2)
)
const checkout = () => {
    router.post(route('checkout'), { items: props.items }, {
        preserveScroll: true,
        onSuccess: () => {
        }
    })
}
</script>
<style lang="scss" scoped>
@use "../../../../assets/styles/colors.scss";
@use "../../../../assets/styles/typography.scss";
@use "../../../../assets/styles/shared.scss";

$breakPoint: 900px;
$breakPoint1: 600px;
$breakPoint2: 450px;
.button-quantity {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    max-width: 9rem;
    overflow: hidden;
    border-radius: 0.5rem;
    border: 0.0625rem solid colors.$charcoal300;
    box-sizing: border-box;
}

.button-quantity__minus,
.button-quantity__plus {
    width: 3rem;
    height: 3rem;

    svg {
        width: 1rem;
        height: 1rem;
    }
}

.button-quantity__quantity {
    width: 3rem;
    height: 3rem;
    line-height: 3rem;
    text-align: center;
}

.button-quantity.disable {
    border-color: colors.$charcoal400;
    .button-quantity__quantity {
        color: colors.$charcoal300;
    }
}

.cart-template__header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.cart-template__header__heading {
    margin: 0;
}

.cart-template__table-wrapper {
    &::-webkit-scrollbar {
        width: 0.25rem;
        height: 0.25rem;
    }

    &::-webkit-scrollbar-track {
        background-color: colors.$charcoal500;
    }

    &::-webkit-scrollbar-thumb {
        background-color: colors.$charcoal400;
    }
    overflow: auto;
}

.cart-template__table {
    width: 100%;

    min-width: 650px;
}

.cart-template__table__header {
    tr {
        border-bottom: 0.0625rem solid colors.$charcoal500;
        th {
            text-align: left;
            color: colors.$charcoal400;
            font-size: 0.875rem;
            letter-spacing: 0.0625rem;
            padding-bottom: 1rem;
            line-height: 1em;
            &:last-of-type {
                text-align: right;
            }
        }
    }
}

.cart-template__table__body {
    tr {
        &:first-of-type {
            td {
                padding: 2rem 1rem 1rem 0;
            }
        }

        &:last-of-type {
            td {
                padding: 1rem 1rem 2rem 0;
            }
        }

        td {
            padding: 1rem 1rem 1rem 0;
            vertical-align: top;

            &:last-of-type {
                padding-right: 0;
            }
        }
    }
}

.cart-template__table__body__row__image-link-price__image {
    max-width: 6rem;
    width: 100%;
    height: auto;
    border-radius: 0.25rem;
    margin-right: 2rem;
    float: left;
}

.cart-template__table__body__row__image-link-price__link {
    display: block;
    margin-bottom: 0.25rem;
}

.cart-template__table__body__row__image-link-price__price {
    color: colors.$charcoal300;
}

.cart-template__table__body__row__quantity {
    width: 10.5rem;
    box-sizing: border-box;
}

.cart-template__table__body__row__quantity__button {
    float: left;
    margin-right: 1rem;
    box-sizing: border-box;

    .button-quantity__minus,
    .button-quantity__plus {
        height: 2rem;
        width: 2rem;
    }

    .button-quantity__quantity {
        height: 2rem;
        width: 2rem;
        line-height: 2rem;
    }
}

.cart-template__table__body__row__quantity__remove {
    height: 2rem;
    width: 2rem;
    float: left;
    position: relative;
    top: 0.0625rem;
    svg {
        height: 1.25rem;
        width: 1.25rem;
        path {
            fill: colors.$charcoal300;
        }
    }

    &:hover {
        svg {
            path {
                fill: colors.$charcoal100;
            }
        }
    }
}

.cart-template__table__body__row__total {
    text-align: right;
    width: 7.5rem;
    box-sizing: border-box;
}

.cart-template__table__body__row__total__text {
    font-size: 1rem;
}

.cart-template__subtotal {
    padding-top: 1rem;
    margin-bottom: 6rem;
    border-top: 0.0625rem solid colors.$charcoal500;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: flex-end;

    @media (max-width: $breakPoint1) {
        border: none;
    }
}

.cart-template__subtotal__heading {
    margin-bottom: 0;
    line-height: 1.5rem;
    height: 1.5rem;
    font-size: 0.875rem;
    display: inline-block;
    margin-right: 1.5rem;
}

.cart-template__subtotal__price {
    font-size: 1.25rem;
    height: 1.5rem;
    line-height: 1.5rem;
    display: inline-block;
}

.cart-template__subtotal__note-row {
    font-size: 0.875rem;
    color: colors.$charcoal300;
}

.cart-template__subtotal__check-out-row__button {
    background-color: colors.$charcoal100;
    color: colors.$charcoal500 !important;
    width: 12rem;
    text-align: center;
}

.cart-template__empty {
    text-align: center;
    padding: 4rem 0 6rem 0;
}

.cart-template__empty__continue {
    text-align: center;
    background-color: colors.$charcoal100;
    color: colors.$charcoal500;
}

.cart-template__best-sellers {
    display: flex;
    flex-flow: column nowrap;
}

.cart-template__best-sellers__heading {
    font-size: 1.25rem;
}

.cart-template__best-sellers__list {
    display: flex;
    flex-flow: row wrap;
    gap: 1.5rem;
    margin-bottom: 2rem;

    li {
        flex-grow: 1;
        flex-basis: 0;
        min-width: 0;

        a {
            height: 100%;
        }
        @media (max-width: $breakPoint) {
            min-width: calc((100% - 3rem) / 2);
        }

        @media (max-width: $breakPoint2) {
            min-width: 100%;
        }
    }
}

.cart-template__best-sellers__view-all-button {
    align-self: center;

    text-align: center;
    background-color: colors.$charcoal100;
    color: colors.$charcoal500 !important;
}
.link {
    color: colors.$charcoal100;
}

.link--plain {
    @extend .link;
}

.link--underlineOnHover {
    @extend .link;

    &:hover {
        text-decoration: underline;
    }
}

.link--button {
    @extend .link;
    display: inline-block;
    border-radius: 0.5rem;
    padding: 0 1.5rem;
    line-height: 3rem;
    height: 3rem;
    transform: scale(0.98);
    transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out, transform 0.3s ease-in-out;

    &:hover {
        transform: scale(1);
    }
}

.link--underlined {
    @extend .link;
    text-decoration: underline;
}
</style>
