<template>
  <div class="am-fs__payments-wrapper" :style="cssVars">
    <div class="am-fs__payments-package">
      <div class="am-fs__payments-package-info">
        <span>{{ amLabels.summary_package }}</span>
      </div>
      <div class="am-fs__payments-package-price">
        <span> {{ pack.name }} ({{  useFormattedPrice(usePackageAmount(store)) }}) x {{ persons + ' ' + (persons > 1 ? amLabels.summary_persons : amLabels.summary_person )}}</span>
        <span> {{ useFormattedPrice(usePackageAmount(store)) }} </span>
      </div>
    </div>
    <div class="am-fs__payments-package-total">
      <div>
        <span>{{amLabels.total_amount_colon}}</span>
        <span>{{ useFormattedPrice(usePackageAmount(store)) }}</span>
      </div>

      <div v-if="hasDeposit && paymentGateway !== 'onSite'">
        <span>{{ amLabels.paying_now }}:</span>
        <span>{{ useFormattedPrice(paymentDeposit ? usePackageAmount(store) : depositAmount) }}</span>
      </div>

      <div v-if="hasDeposit && paymentGateway !== 'onSite'">
        <span>{{ amLabels.paying_later }}:</span>
        <span>{{ useFormattedPrice(paymentDeposit ? 0 : (usePackageAmount(store) - depositAmount)) }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useFormattedPrice } from '../../../../../assets/js/common/formatting.js'
import {
  usePackageAmount, usePackageDepositAmount
} from '../../../../../assets/js/public/package.js'
import {
  computed,
  inject, reactive, ref,
} from 'vue'
import {useStore} from 'vuex'
import {useColorTransparency} from "../../../../../assets/js/common/colorManipulation";

// * Define store
const store = useStore()

// * Labels
const amLabels = inject('amLabels')

let persons = ref(store.getters['booking/getBookingPersons'])

let pack = reactive(store.getters['entities/getPackage'](
    store.getters['booking/getPackageId']
))

let paymentGateway = computed(() => store.getters['booking/getPaymentGateway'])

let paymentDeposit = computed(() => store.getters['booking/getPaymentDeposit'])
let hasDeposit = inject('hasDeposit')
let depositAmount = computed(() => usePackageDepositAmount(
    pack,
    usePackageAmount(store)
  )
)

// * Colors
let amColors = inject('amColors')
let cssVars = computed(() => {
  return {
    '--am-c-pay-text': amColors.value.colorMainText,
    '--am-c-pay-text-op70': useColorTransparency(amColors.value.colorMainText, 0.7),
    '--am-c-pay-text-op60': useColorTransparency(amColors.value.colorMainText, 0.6),
    '--am-c-pay-text-op30': useColorTransparency(amColors.value.colorMainText, 0.3),
    '--am-c-pay-success': amColors.value.colorSuccess,
    '--am-c-pay-primary': amColors.value.colorPrimary,
  }
})
</script>

<script>
export default {
  name: 'AppointmentInfo'
}
</script>

<style lang="scss">
.amelia-v2-booking {
  #amelia-container {
    .am-fs__payments-package {
      border: 1px solid var(--am-c-pay-text-op60);
      border-radius: 8px;
      padding: 12px;
      margin: 0 0 16px;

      &-info {
        margin-bottom: 8px;
        span {
          font-weight: 500;
          font-size: 12px;
          line-height: 16px;
          /* $shade-500 */
          color: var(--am-c-pay-text-op60);
        }
      }

      &-price {
        font-weight: 400;
        font-size: 13px;
        line-height: 18px;
        /* $shade-900 */
        color: var(--am-c-pay-text);
        display: flex;
        justify-content: space-between;
      }

      &-total {
        & > div {
          display: flex;
          justify-content: space-between;
          padding-top:8px;
          font-weight: 500;
          font-size: 15px;
          line-height: 20px;
          /* $shade-900 */
          color: var(--am-c-pay-text);
        }
      }
    }
  }
}

</style>
