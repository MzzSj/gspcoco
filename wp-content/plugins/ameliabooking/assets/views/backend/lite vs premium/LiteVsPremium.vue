<template>
  <div id="am-lite-vs-premium" class="am-wrap">
    <div class="am-body">

      <!-- Page Header -->
      <page-header></page-header>
      <!-- /Page Header -->

      <div class="am-lite-vs-premium-welcome am-section am-lite-vs-premium-section">

        <div class="am-lite-vs-premium-welcome-left">

          <div class="am-lite-vs-premium-welcome-title">{{ $root.labels.amelia_plans_comparison }}</div>

          <div class="am-lite-vs-premium-welcome-subtitle">{{ $root.labels.upgrade_to_premium }}</div>

          <a class="am-lite-vs-premium-btn" href="https://wpamelia.com/pricing/?utm_source=amelia-lite&utm_medium=lite-upgrade&utm_content=amelia&utm_campaign=amelia-lite" target="_blank">
            {{ $root.labels.upgrade_now }}
          </a>

        </div>

        <div class="am-lite-vs-premium-welcome-right">
          <img :src="$root.getUrl+'public/img/am-lite-vs-premium.webp'" />
        </div>

        <div class="am-lite-vs-premium-welcome-border">
        </div>

      </div>

      <div class="am-lite-vs-premium-table am-section am-lite-vs-premium-section">

        <el-row class="am-lite-vs-premium-table-row-header">
          <el-col class="el-table_1_column_1 cell" :span="12" :sm="8"><div>Features</div></el-col>
          <el-col class="el-table_1_column_2 cell" :span="3" :sm="4"><div>Lite</div></el-col>
          <el-col class="el-table_1_column_3 cell" :span="3" :sm="4"><div>Basic</div></el-col>
          <el-col class="el-table_1_column_4 cell" :span="3" :sm="4"><div>Pro</div></el-col>
          <el-col class="el-table_1_column_5 cell" :span="3" :sm="4"><div>Developer</div></el-col>
        </el-row>

        <el-row class="am-lite-vs-premium-table-row" v-for="item in features" :key="item.feature">
          <el-col :span="12" :sm="8" class="am-lite-vs-premium-table-feature">
            <div class="am-lite-vs-premium-table-feature-name">{{ item.feature }}</div>
            <el-tag
                v-if="item.tag"
                :type="item.tag === 'Soon' ? '' : 'success'"
                disable-transitions
            >{{ item.tag }}
            </el-tag>
          </el-col>

          <el-col :span="3" :sm="4" class="am-lite-vs-premium-table-col-lite">
              <div :class="typeof item.lite === 'boolean' ? (item.lite ? 'am-blue-check' : 'am-minus') : ''">
                {{typeof item.lite !== 'boolean' ? item.lite : ''}}
                <el-tooltip placement="top" v-if="item.lite == 'Limited' && item.feature == 'Support'">
                  <div slot="content" v-html="$root.labels.lite_support_tooltip"></div>
                  <i class="el-icon-info am-tooltip-icon"></i>
                </el-tooltip>
              </div>
          </el-col>

          <el-col :span="3" :sm="4" class="am-lite-vs-premium-table-col-basic">
            <div :class="typeof item.basic === 'boolean' ? (item.basic ? 'am-blue-check' : 'am-minus') : ''">
              {{typeof item.basic !== 'boolean' ? item.basic : ''}}
            </div>
          </el-col>

          <el-col :span="3" :sm="4" class="am-lite-vs-premium-table-col-pro">
            <div :class="typeof item.pro === 'boolean' ? (item.pro ? 'am-blue-check' : 'am-minus') : ''">
              {{typeof item.pro !== 'boolean' ? item.pro : ''}}
            </div>
          </el-col>

          <el-col :span="3" :sm="4" class="am-lite-vs-premium-table-col-developer">
              <div :class="typeof item.developer === 'boolean' ? (item.developer ? 'am-blue-check' : 'am-minus') : ''">
                {{typeof item.developer !== 'boolean' ? item.developer : ''}}
              </div>
          </el-col>
        </el-row>

        <div class="am-lite-vs-premium-table-btn-holder">
          <a class="am-lite-vs-premium-btn" href="https://wpamelia.com/pricing/?utm_source=amelia-lite&utm_medium=lite-upgrade&utm_content=amelia&utm_campaign=amelia-lite" target="_blank">
            {{ $root.labels.upgrade_now }}
          </a>
        </div>

      </div>

    </div>
  </div>
</template>

<script>
import PageHeader from '../parts/PageHeader.vue'

export default {

  data () {
    return {
      blogPosts: [],
      changelog: {
        version: '6.5',
        changes: []
      },
      features: [
        {
          feature: 'Domain',
          lite: '1',
          basic: '1',
          pro: 'up to 3',
          developer: 'up to 1000'
        },
        {
          feature: 'Support',
          lite: 'Limited',
          basic: 'Premium',
          pro: 'Premium',
          developer: 'Premium'
        },
        {
          feature: 'Unlimited Appointments and Events',
          lite: true,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Customizable Design',
          lite: true,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Automated Notification Management (SMS and Email)',
          lite: 'Limited',
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'No-code Website Builder and Embeddable Booking Form',
          lite: true,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Import Customers\' data',
          lite: true,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Multiple Booking Forms',
          lite: true,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Group Appointment Bookings',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Unlimited Employees',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Management of Multiple Locations',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Recurring Appointments and Events',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Employee and Customer Panel',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Deposit Payments',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Discount coupons',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Service Extras',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Custom Service Duration',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Multilingual Support',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: '4 Payment Providers (Mollie, PayPal, Stripe, Razorpay)',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'WooCommerce Payments',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Marketing Tools and Analytics (Google Analytics, Facebook Pixel)',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Online Platforms (Zoom, GoogleMeet, LessonSpace)',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Calendar Synchronizations (Google Calendar, Outlook)',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'WebHooks (Zapier and MailChimp)',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'Payment links',
          lite: false,
          basic: true,
          pro: true,
          developer: true
        },
        {
          feature: 'WhatsApp integration',
          lite: false,
          basic: false,
          pro: true,
          developer: true,
          tag: 'New'
        },
        {
          feature: 'Packages of Services',
          lite: false,
          basic: false,
          pro: true,
          developer: true
        },
        {
          feature: 'Resources',
          lite: false,
          basic: false,
          pro: true,
          developer: true,
          tag: 'New'
        },
        {
          feature: 'Refund option',
          lite: false,
          basic: false,
          pro: true,
          developer: true,
          tag: 'New'
        },
        {
          feature: 'Cart',
          lite: false,
          basic: false,
          pro: true,
          developer: true,
          tag: 'Soon'
        }
        /*{
          feature: 'Waiting List',
          lite: false,
          basic: false,
          pro: true,
          developer: true,
          tag: 'Soon'
        },
        {
          feature: 'Reviews',
          lite: false,
          basic: false,
          pro: true,
          developer: true,
          tag: 'Soon'
        }*/
      ]
    }
  },

  methods: {
    getNews () {
    },

    getIconType (type) {
      let typeToReturn = type.toLowerCase()

      switch (typeToReturn) {
        case 'improvement':
        case 'bugfix':
        case 'feature':
        case 'translations':
          return typeToReturn
        default:
          return 'plus'
      }
    }
  },

  created () {
    this.getNews()
  },

  components: {
    PageHeader
  }
}
</script>
