import { NgModule } from "@angular/core";
import { PreloadAllModules, RouterModule, Routes } from "@angular/router";

const routes: Routes = [
  {
    path: "home",
    loadChildren: () =>
      import("./pages/home/home.module").then((m) => m.HomePageModule),
  },
  {
    path: "",
    redirectTo: "tabs/home",
    pathMatch: "full",
  },
  {
    path: "login",
    loadChildren: () =>
      import("./pages/login/login.module").then((m) => m.LoginPageModule),
  },
  {
    path: "signup",
    loadChildren: () =>
      import("./pages/signup/signup.module").then((m) => m.SignupPageModule),
  },
  {
    path: "otp",
    loadChildren: () =>
      import("./pages/otp/otp.module").then((m) => m.OtpPageModule),
  },
  {
    path: "newpassword",
    loadChildren: () =>
      import("./pages/newpassword/newpassword.module").then(
        (m) => m.NewpasswordPageModule
      ),
  },
  {
    path: "forgot",
    loadChildren: () =>
      import("./pages/forgot/forgot.module").then((m) => m.ForgotPageModule),
  },
  {
    path: 'product-view',
    loadChildren: () => import('./pages/product-view/product-view.module').then( m => m.ProductViewPageModule)
  },
  {
    path: 'cart',
    loadChildren: () => import('./pages/cart/cart.module').then( m => m.CartPageModule)
  },
  {
    path: 'make-payment',
    loadChildren: () => import('./pages/make-payment/make-payment.module').then( m => m.MakePaymentPageModule)
  },
  {
    path: 'coupon',
    loadChildren: () => import('./pages/coupon/coupon.module').then( m => m.CouponPageModule)
  },
  {
    path: 'payment-done',
    loadChildren: () => import('./pages/payment-done/payment-done.module').then( m => m.PaymentDonePageModule)
  },
  {
    path: 'orders',
    loadChildren: () => import('./pages/orders/orders.module').then( m => m.OrdersPageModule)
  },
  {
    path: 'billing-detail',
    loadChildren: () => import('./pages/billing-detail/billing-detail.module').then( m => m.BillingDetailPageModule)
  },
  {
    path: 'cancel-order',
    loadChildren: () => import('./pages/cancel-order/cancel-order.module').then( m => m.CancelOrderPageModule)
  },
  {
    path: 'profile',
    loadChildren: () => import('./pages/profile/profile.module').then( m => m.ProfilePageModule)
  },
  {
    path: 'edit-profile',
    loadChildren: () => import('./pages/edit-profile/edit-profile.module').then( m => m.EditProfilePageModule)
  },
  {
    path: 'manage-address',
    loadChildren: () => import('./pages/manage-address/manage-address.module').then( m => m.ManageAddressPageModule)
  },
  {
    path: 'add-address',
    loadChildren: () => import('./modals/add-address/add-address.module').then( m => m.AddAddressPageModule)
  },
  {
    path: 'terms',
    loadChildren: () => import('./pages/terms/terms.module').then( m => m.TermsPageModule)
  },
  {
    path: 'privacy',
    loadChildren: () => import('./pages/privacy/privacy.module').then( m => m.PrivacyPageModule)
  },
  {
    path: 'calendar',
    loadChildren: () => import('./modals/calendar/calendar.module').then( m => m.CalendarPageModule)
  },
  {
    path: 'tabs',
    loadChildren: () => import('./pages/tabs/tabs.module').then( m => m.TabsPageModule)
  },
  {
    path: 'verify',
    loadChildren: () => import('./pages/verify/verify.module').then( m => m.VerifyPageModule)
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules }),
  ],
  exports: [RouterModule],
})
export class AppRoutingModule {}
