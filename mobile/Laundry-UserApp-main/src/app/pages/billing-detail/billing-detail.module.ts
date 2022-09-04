import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { BillingDetailPageRoutingModule } from './billing-detail-routing.module';

import { BillingDetailPage } from './billing-detail.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    BillingDetailPageRoutingModule
  ],
  declarations: [BillingDetailPage]
})
export class BillingDetailPageModule {}
