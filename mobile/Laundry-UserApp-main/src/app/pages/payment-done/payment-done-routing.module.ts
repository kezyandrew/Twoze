import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { PaymentDonePage } from './payment-done.page';

const routes: Routes = [
  {
    path: '',
    component: PaymentDonePage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PaymentDonePageRoutingModule {}
