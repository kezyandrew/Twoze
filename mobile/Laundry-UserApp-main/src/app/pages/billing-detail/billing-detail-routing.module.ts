import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { BillingDetailPage } from './billing-detail.page';

const routes: Routes = [
  {
    path: '',
    component: BillingDetailPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class BillingDetailPageRoutingModule {}
