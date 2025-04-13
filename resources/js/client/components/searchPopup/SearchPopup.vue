<template>
    <div v-if="isOpen" class="popup-overlay" @click.self="closePopup">
      <div class="popup">
        <h3>Authenticity Check</h3>
        <input v-model="barcode" type="text" placeholder="Enter barcode" @input="searchProduct" />
         <button @click="searchProduct">Search</button>

        <div class="product-info" v-if="product">
            <div class="product-header">
              <h4 class="product-title">CERTIFICATION OF AUTHENTICITY</h4>
            </div>

            <div class="product-details">
              <p><strong>Title:</strong> {{ product.title }}</p>
              <p><strong>Item:</strong> {{ product.item }}</p>
              <p><strong>Gold:</strong> {{ product.gold }}</p>
              <p><strong>Silver:</strong> {{ product.silver }}</p>
              <p><strong>Stone:</strong> {{ product.stone }}</p>
              <p><strong>Other Materials:</strong> {{ product.other_materials }}</p>
            </div>

            <div class="product-pricing">
              <p><strong>Price:</strong> {{ product.price_exclusive }}</p>
              <p><strong>Handcrafted:</strong> {{ product.handcrafted ? 'Yes' : 'No' }}</p>
              <p><strong>Exclusive Edition:</strong> {{ product.exclusive_edition ? 'Yes' : 'No' }}</p>
              <p><strong>Show Product:</strong>
                  <Link :href="'/auth-check/'+product.product_id" @click="closePopup">
                      <p>
                        {{ product.title }}
                      </p>
                  </Link>
              </p>
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
      width: 300px !important;
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
    width: 10%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }

  button {
    padding: 10px 15px;
    margin-top: 10px;
    cursor: pointer;
  }
  </style>
