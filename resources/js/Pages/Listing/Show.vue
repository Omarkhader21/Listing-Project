<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="col-span-12 md:col-span-6 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">
                images
            </div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>
                    Basic info
                </template>
                <Price :price="listing.price" class="text-2xl"/>
                <ListingSpace :listing="listing" class="text-lg"/>
                <ListingAddress :listing="listing" class="text-gray-500"/>
            </Box>
            <Box>
                <template #header>
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Interest rate ({{ interestRate }}%) </label>
                    <input type="range" min="0.1" max="30" step="0.1" v-model.number="interestRate"
                           class="w-full h-4 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>

                    <label class="label">Duration ({{ duration }}) </label>
                    <input type="range" min="3" max="35" step="1" v-model.number="duration"
                           class="w-full h-4 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"/>
                </div>
                <div class="text-gray-600 dark:text-gray-300 mt-2">
                    <div class="text-gray-400">
                        Your Monthly Payment
                    </div>
                    <Price :price="monthlyPayment" class="text-3xl"></Price>
                </div>
                <div class="mt-2 text-gray-500">
                    <div class="flex justify-between">
                        <div>
                            Total Paid
                        </div>
                        <div>
                            <Price :price="totalPaid" class="font-medium"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            Principle Paid
                        </div>
                        <div>
                            <Price :price="listing.price" class="font-medium"/>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>
                            Interest Paid
                        </div>
                        <div>
                            <Price :price="totalInterest" class="font-medium"/>
                        </div>
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>
<script setup>
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import {ref} from 'vue';
import {useMonthlyPayment} from "@/Composables/useMonthlyPayment.js";

const interestRate = ref(2.5);
const duration = ref(25);

const props = defineProps({
    listing: Object,
});

const {monthlyPayment, totalPaid, totalInterest} = useMonthlyPayment(props.listing.price, interestRate, duration);
</script>