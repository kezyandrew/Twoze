import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { PaymentDonePageRoutingModule } from './payment-done-routing.module';

import { PaymentDonePage } from './payment-done.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    PaymentDonePageRoutingModule
  ],
  declarations: [PaymentDonePage]
})
export class PaymentDonePageModule {}
