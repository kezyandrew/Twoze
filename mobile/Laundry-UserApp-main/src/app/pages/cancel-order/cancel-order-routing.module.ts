import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { CancelOrderPage } from './cancel-order.page';

const routes: Routes = [
  {
    path: '',
    component: CancelOrderPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CancelOrderPageRoutingModule {}
