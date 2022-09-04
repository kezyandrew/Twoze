import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { CancelOrderPageRoutingModule } from './cancel-order-routing.module';

import { CancelOrderPage } from './cancel-order.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    CancelOrderPageRoutingModule
  ],
  declarations: [CancelOrderPage]
})
export class CancelOrderPageModule {}
