import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { TabsPage } from './tabs.page';

const routes: Routes = [
  {
    path: '',
    component: TabsPage,
    children: [
      {
        path: 'home',
        children: [
          {
            path: '',
            loadChildren: ()=>import('../../pages/home/home.module').then(m=>m.HomePageModule)
          },
          {
            path:'cart',
            loadChildren: ()=>import('../../pages/cart/cart.module').then(m=>m.CartPageModule)
          },
          {
            path:'make-payment',
            loadChildren: ()=>import('../../pages/make-payment/make-payment.module').then(m=>m.MakePaymentPageModule)
          },
          {
            path:'coupon',
            loadChildren: ()=>import('../../pages/coupon/coupon.module').then(m=>m.CouponPageModule)
          }
        ]
      },
      {
        path: 'orders',
        children: [
          {
            path: '',
            loadChildren: ()=>import('../../pages/orders/orders.module').then(m=>m.OrdersPageModule)
          },
          {
            path:'billing-detail',
            loadChildren: ()=>import('../../pages/billing-detail/billing-detail.module').then(m=>m.BillingDetailPageModule)
          }
        ]
      },
      {
        path: 'profile',
        children: [
          {
            path: '',
            loadChildren:()=>import('../../pages/profile/profile.module').then(m=>m.ProfilePageModule),
          },
        ]
      },
    ]
  },
  {
    path: '',
    redirectTo: 'tabs/home',
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class TabsPageRoutingModule {}
