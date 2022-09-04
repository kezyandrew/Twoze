import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { PaymentDonePage } from './payment-done.page';

describe('PaymentDonePage', () => {
  let component: PaymentDonePage;
  let fixture: ComponentFixture<PaymentDonePage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PaymentDonePage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(PaymentDonePage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
