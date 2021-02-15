export default {
  items: [
    {
      name: 'Dashboard',
      url: '/dashboard',
      icon: 'icon-speedometer',
      badge: {
        variant: 'primary',
        // text: 'NEW'
      }
    },
    
    {
      name: 'Clients',
      url: '/contact/list',
      icon: 'fa fa-address-card-o'
    },
    {
      name: 'Rubel Workers',
      url: '/recruiting',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Recruiting',
          url: '/rubel/recruiting',
          icon: 'fas fa-passport'
        },
        {
          name: 'Processing',
          url: '/rubel/processing',
          icon: 'fas fa-passport'
        },

      ]
    },
    {
      name: 'Amir Workers',
      url: '/recruiting',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Recruiting',
          url: '/amir/recruiting',
          icon: 'fas fa-passport'
        },
        {
          name: 'Processing',
          url: '/amir/processing',
          icon: 'fas fa-passport'
        },

      ]
    },
    {
      name: 'Nahar Workers',
      url: '/recruiting',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Recruiting',
          url: '/nahar/recruiting',
          icon: 'fas fa-passport'
        },
        {
          name: 'Processing',
          url: '/nahar/processing',
          icon: 'fas fa-passport'
        },

      ]
    },
    {
      name: 'Female',
      url: '/recruiting',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Recruiting',
          url: '/female/recruiting',
          icon: 'fas fa-passport'
        },
      ]
    },
    
    {
      name: 'Items',
      url: '/category',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Category',
          url: '/category',
          icon: 'fa fa-life-bouy'
        },
        {
          name: 'item',
          url: '/item',
          icon: 'fa fa-life-bouy'
        },
      ]
    },
    
    // {
    //   name: 'Flat',
    //   url: '/flat',
    //   icon: 'fa fa-institution'
    // },
    // {
    //   name: 'Plot',
    //   url: '/plot',
    //   icon: 'fa fa-object-ungroup'
    // },
    {
      name: 'Account',
      url: '/purpose',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Purpose',
          url: '/purpose',
          icon: 'fa fa-object-ungroup'
        },
      ]
    },
    
    {
      name: 'Money In',
      url: '/income',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Income',
          url: '/income',
          icon: 'fa fa-object-ungroup'
        },
        {
          name: 'Invoice',
          url: '/invoice',
          icon: 'fa fa-object-ungroup'
        },
        {
          name: 'P Received',
          url: '/payment-received',
          icon: 'fa fa-object-ungroup'
        },
        // {
        //   name: 'Installment',
        //   url: '/installment',
        //   icon: 'fa fa-object-ungroup'
        // }
      ]
    },
    {
      name: 'Money Out',
      url: '/expense',
      icon: 'fa fa-money',
      children: [
        {
          name: 'Expense',
          url: '/expense',
          icon: 'fa fa-object-ungroup'
        },
        {
          name: 'Bills',
          url: '/bills',
          icon: 'fa fa-object-ungroup'
        },{
          name: 'Payment Made',
          url: '/payment-made',
          icon: 'fa fa-object-ungroup'
        },
      ]
    },
    
    {
      name: 'Report',
      url: '/report',
      icon: 'fa fa-object-ungroup'
    },
    {
      name: 'Messaging',
      url: '/messaging',
      icon: 'fa fa-object-ungroup'
    },
    
    // {
    //   name: 'Income',
    //   url: '/income',
    //   icon: 'fa fa-money',
    //   children: [
        // {
        //   name: 'Advance Payment',
        //   url: '/income/advance-payment',
        //   icon: 'fa fa-dollar'
        // },
        // {
        //   name: 'Booking/Sale',
        //   url: '/income/booking',
        //   icon: 'fa fa-bookmark-o'
        // },
        // {
        //   name: 'Installment',
        //   url: '/income/installment',
        //   icon: 'fa fa-list-alt'
        // },
        // {
        //   name: 'Other Income',
        //   url: '/income/other-income',
        //   icon: 'fa fa-dollar'
        // },
        // {
        //   name: 'Payment Schedule',
        //   url: '/income/payment-schedule',
        //   icon: 'fa fa-list-alt'
        // },
        // {
        //   name: 'Party Leadger',
        //   url: '/income/leadger',
        //   icon: 'fa fa-table'
        // },
      // ]
    // },
    
    {
      name: 'System Users',
      url: '/user-role',
      icon: 'fa fa-money',
      children: [
        {
          name: 'User Role',
          url: '/user-role',
          icon: 'icon-star'
        },
        {
          name: 'Assign Role',
          url: '/assign-role',
          icon: 'icon-star'
        },
      ]
    },
    
    // {
    //   name: 'Expense',
    //   url: '/expense',
    //   icon: 'cui-dollar icons',
    //   children: [
    //     {
    //       name: 'Expense Type',
    //       url: '/income/expense-type',
    //       icon: 'cui-layers icons'
    //     },
    //     {
    //       name: 'Project Expense',
    //       url: '/income/booking',
    //       icon: 'fa fa-dollar'
    //     },
    //     {
    //       name: 'Other Expense',
    //       url: '/income/installment',
    //       icon: 'fa fa-dollar'
    //     }
    //   ]
    // },
    // {
    //   title: true,
    //   name: 'Report',
    //   class: '',
    //   wrapper: {
    //     element: '',
    //     attributes: {}
    //   }
    // },
    // {
    //   name: 'Income Report',
    //   url: '/income-report',
    //   icon: 'fa fa-linode',
    //   children: [
    //     {
    //       name: 'Payment Report',
    //       url: '/income-report/advance-payment-report',
    //       icon: 'fa fa-money'
    //     },
    //     {
    //       name: 'Other Income Report',
    //       url: '/income-report/other-income-report',
    //       icon: 'fa fa-money'
    //     }
    //   ]
    // },
    // {
    //   name: 'Expense Report',
    //   url: '/income-report',
    //   icon: 'fa fa-minus-square-o',
    //   children: [
    //     {
    //       name: 'ProjectExpense Report',
    //       url: '/income-report/advance-payment-report',
    //       icon: 'fa fa-gbp'
    //     },
    //     {
    //       name: 'Other Expense Report',
    //       url: '/income-report/other-income-report',
    //       icon: 'fa fa-gbp'
    //     }
    //   ]
    // },
    // {
    //   title: true,
    //   name: 'Theme',
    //   class: '',
    //   wrapper: {
    //     element: '',
    //     attributes: {}
    //   }
    // },
    // {
    //   name: 'Colors',
    //   url: '/theme/colors',
    //   icon: 'icon-drop'
    // },
    // {
    //   name: 'Typography',
    //   url: '/theme/typography',
    //   icon: 'icon-pencil'
    // },
    // {
    //   title: true,
    //   name: 'Components',
    //   class: '',
    //   wrapper: {
    //     element: '',
    //     attributes: {}
    //   }
    // },
    // {
    //   name: 'Base',
    //   url: '/base',
    //   icon: 'icon-puzzle',
    //   children: [
    //     {
    //       name: 'Breadcrumbs',
    //       url: '/base/breadcrumbs',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Cards',
    //       url: '/base/cards',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Carousels',
    //       url: '/base/carousels',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Collapses',
    //       url: '/base/collapses',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Forms',
    //       url: '/base/forms',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Jumbotrons',
    //       url: '/base/jumbotrons',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'List Groups',
    //       url: '/base/list-groups',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Navs',
    //       url: '/base/navs',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Navbars',
    //       url: '/base/navbars',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Paginations',
    //       url: '/base/paginations',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Popovers',
    //       url: '/base/popovers',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Progress Bars',
    //       url: '/base/progress-bars',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Switches',
    //       url: '/base/switches',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Tables',
    //       url: '/base/tables',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Tabs',
    //       url: '/base/tabs',
    //       icon: 'icon-puzzle'
    //     },
    //     {
    //       name: 'Tooltips',
    //       url: '/base/tooltips',
    //       icon: 'icon-puzzle'
    //     }
    //   ]
    // },
    // {
    //   name: 'Buttons',
    //   url: '/buttons',
    //   icon: 'icon-cursor',
    //   children: [
    //     {
    //       name: 'Buttons',
    //       url: '/buttons/standard-buttons',
    //       icon: 'icon-cursor'
    //     },
    //     {
    //       name: 'Button Dropdowns',
    //       url: '/buttons/dropdowns',
    //       icon: 'icon-cursor'
    //     },
    //     {
    //       name: 'Button Groups',
    //       url: '/buttons/button-groups',
    //       icon: 'icon-cursor'
    //     },
    //     {
    //       name: 'Brand Buttons',
    //       url: '/buttons/brand-buttons',
    //       icon: 'icon-cursor'
    //     }
    //   ]
    // },
    // {
    //   name: 'Charts',
    //   url: '/charts',
    //   icon: 'icon-pie-chart'
    // },
    // {
    //   name: 'Icons',
    //   url: '/icons',
    //   icon: 'icon-star',
    //   children: [
    //     {
    //       name: 'CoreUI Icons',
    //       url: '/icons/coreui-icons',
    //       icon: 'icon-star',
    //       badge: {
    //         variant: 'info',
    //         text: 'NEW'
    //       }
    //     },
    //     {
    //       name: 'Flags',
    //       url: '/icons/flags',
    //       icon: 'icon-star'
    //     },
    //     {
    //       name: 'Font Awesome',
    //       url: '/icons/font-awesome',
    //       icon: 'icon-star',
    //       badge: {
    //         variant: 'secondary',
    //         text: '4.7'
    //       }
    //     },
    //     {
    //       name: 'Simple Line Icons',
    //       url: '/icons/simple-line-icons',
    //       icon: 'icon-star'
    //     }
    //   ]
    // },
    // {
    //   name: 'Notifications',
    //   url: '/notifications',
    //   icon: 'icon-bell',
    //   children: [
    //     {
    //       name: 'Alerts',
    //       url: '/notifications/alerts',
    //       icon: 'icon-bell'
    //     },
    //     {
    //       name: 'Badges',
    //       url: '/notifications/badges',
    //       icon: 'icon-bell'
    //     },
    //     {
    //       name: 'Modals',
    //       url: '/notifications/modals',
    //       icon: 'icon-bell'
    //     }
    //   ]
    // },
    // {
    //   name: 'Widgets',
    //   url: '/widgets',
    //   icon: 'icon-calculator',
    //   badge: {
    //     variant: 'primary',
    //     text: 'NEW'
    //   }
    // },
    // {
    //   divider: true
    // },
    // {
    //   title: true,
    //   name: 'Extras'
    // },
    // {
    //   name: 'Pages',
    //   url: '/pages',
    //   icon: 'icon-star',
    //   children: [
    //     {
    //       name: 'Login',
    //       url: '/pages/login',
    //       icon: 'icon-star'
    //     },
    //     {
    //       name: 'Register',
    //       url: '/pages/register',
    //       icon: 'icon-star'
    //     },
    //     {
    //       name: 'Error 404',
    //       url: '/pages/404',
    //       icon: 'icon-star'
    //     },
    //     {
    //       name: 'Error 500',
    //       url: '/pages/500',
    //       icon: 'icon-star'
    //     }
    //   ]
    // },
    // {
    //   name: 'Disabled',
    //   url: '/dashboard',
    //   icon: 'icon-ban',
    //   badge: {
    //     variant: 'secondary',
    //     text: 'NEW'
    //   },
    //   attributes: { disabled: true },
    // },
    // {
    //   name: 'Download CoreUI',
    //   url: 'http://coreui.io/vue/',
    //   icon: 'icon-cloud-download',
    //   class: 'mt-auto',
    //   variant: 'success',
    //   attributes: { target: '_blank', rel: 'noopener' }
    // },
    // {
    //   name: 'Try CoreUI PRO',
    //   url: 'http://coreui.io/pro/vue/',
    //   icon: 'icon-layers',
    //   variant: 'danger',
    //   attributes: { target: '_blank', rel: 'noopener' }
    // },
    
    
  ],
}
