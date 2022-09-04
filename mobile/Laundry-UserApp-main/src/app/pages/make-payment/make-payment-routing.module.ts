import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { MakePaymentPage } from './make-payment.page';

const routes: Routes = [
  {
    path: '',
    component: MakePaymentPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class MakePaymentPageRoutingModule {}
