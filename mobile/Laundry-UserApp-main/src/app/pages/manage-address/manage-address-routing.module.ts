import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ManageAddressPage } from './manage-address.page';

const routes: Routes = [
  {
    path: '',
    component: ManageAddressPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ManageAddressPageRoutingModule {}
