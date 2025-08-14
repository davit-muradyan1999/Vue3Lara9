<template>
    <div v-if="isOpen" class="popup-overlay" @click.self="closePopup">
      <div class="popup">
          <div v-if="!product">
              <h3>{{ $t('auth_check') }}</h3>
              <div class="flex flex-col items-center justify-center">
                  <input v-model="barcode" type="text" placeholder="" @input="searchProduct" />
                  <button @click="searchProduct" class="bg-blue-700 text-white rounded">{{ $t('search') }}</button>
              </div>
          </div>

        <div v-if="product">
           <div class="!flex !flex-col !justify-center !items-center !w-full">
               <div>
                   <img src="/public/client/icons/logo.png"  alt="logo">
               </div>
               <div class="!flex !items-center !gap-4 !my-8 !w-full text-gray-700">
                   <div class="!flex-grow !border-t !border-gray-700"></div>
                   <h1 class="tracking-wider whitespace-nowrap !text-xs sm:!text-sm md:!text-lg lg:!text-lg xl:!text-2xl">CERTIFICATION OF AUTHENTICITY</h1>
                   <div class="!flex-grow !border-t !border-gray-700"></div>
               </div>
           </div>

            <div class="lg:flex lg:justify-between">
              <div class="lg:w-1/3 text-gray-700"  style="word-spacing: 0.2rem">
                  <p>Serial No.: {{ product.barcode }}</p>
                  <p v-if="product.title">Title: {{ product.title }}</p>
                  <p v-if="product.item">Item: {{ product.item }}</p>
                  <p v-if="product.gold">Gold: {{ product.gold }}</p>
                  <p v-if="product.stone">Stone: {{ product.stone }}</p>
                  <p v-if="product.silver">Silver: {{ product.silver }}</p>
                  <p v-if="product.other_materials">Other Materials: {{ product.other_materials }}</p>
                  <p v-if="product.price_exclusive">Price: Exclusive</p>
                  <p v-if="product.handcrafted">Handcrafted</p>
                  <p v-if="product.exclusive_edition">Exclusive Edition</p>
                  <p class="flex gap-1">Show Product:

                      <Link :href="'/auth-check/'+product.product_id" @click="closePopup">
                          {{ product.title }}
                      </Link>
                  </p>
              </div>
              <div class="!flex-grow bg-gray-700 max-w-full w-full h-[1px] !my-2 lg:max-w-[1px] lg:w-[1px] lg:h-auto lg:!my-0"></div>
              <div class="lg:w-1/2 text-gray-700">
                  <p style="word-spacing: 0.2rem">
                      Dvingold hereby guarantees that all the particulars herewith written are true and accurate. We confirm that above items are genuine and of perfect quality. This item is unique authorial work that has been manufactured and inspected to the highest standards. This item is registered as industrial design by the standards of World Intellectual Property Organization. The information above is available online any time at www.dvingold.com (http://www.dvingold.com/).
                  </p>
                  <img src="/public/client/images/sign.png" alt="sign" style="float: right">
              </div>
            </div>

          </div>
          <div v-if="errorMessage" class="error-message">
              <p style="color: red; font-size: 15px">{{ errorMessage }}</p>
          </div>
        <!-- <button @click="closePopup">Close</button> -->
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  import {Link, router, usePage} from "@inertiajs/vue3";

  const isOpen = ref(false);
  const barcode = ref('');
  const product = ref(null);
  const errorMessage = ref('');

  const openPopup = () => {
    isOpen.value = true;
    document.body.classList.toggle('lock');
  };

  const closePopup = () => {
    isOpen.value = false;
    barcode.value = '';
    product.value = null;
  };

  const searchProduct = async () => {
      if (barcode.value.trim() === '') return;

      try {
          if (barcode.value.length < 3) {
              return;
          }
          if (!/^\d+$/.test(barcode.value)) {
              errorMessage.value = "Barcode must be numeric";
              return;
          }
          const response = await axios.get(`/api/authenticity-check/${barcode.value}`);
          product.value = response.data;
          errorMessage.value = '';
      } catch (error) {
          product.value = null;
          if (error.response && error.response.status === 404) {
              errorMessage.value = 'Product not found';
          } else {
              errorMessage.value = 'An error occurred while searching';
          }
      }
  };

  defineExpose({
    openPopup,
  });
  </script>

  <style scoped>
  h3{
      font-size: 20px;
      margin-bottom: 10px;
  }
  input{
      max-width: 300px !important;
      width: 100%;
      font-size: 16px;
  }
  .product-info{
    display: flex;
    flex-direction: column;
    align-items: center;
    line-height: normal;
    font-size: 14px;
    background: #f9f9f9;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .product-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
  }

  .product-title {
    font-size: 24px;
    font-weight: bold;
    color: #333;
  }

  .product-item {
    font-size: 16px;
    color: #777;
  }

  .product-details {
    margin-bottom: 20px;
  }

  .product-details p {
    font-size: 16px;
    color: #555;
    margin: 5px 0;
  }

  .product-pricing p {
    font-size: 18px;
    color: #333;
    font-weight: bold;
    margin: 10px 0;
  }
  .popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

  .popup {
    background: white;
    padding: 20px;
    border-radius: 8px;
    width: 40%;
  }

  input {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  button {
    padding: 10px 15px;
    margin-top: 10px;
    cursor: pointer;
  }
  @media screen and (max-width: 1024px) {
      .popup{
          width: 60%;
          height: 90%;
          overflow-y: auto;
      }
  }
  </style>
