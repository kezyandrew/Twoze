import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { MakePaymentPage } from './make-payment.page';

describe('MakePaymentPage', () => {
  let component: MakePaymentPage;
  let fixture: ComponentFixture<MakePaymentPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MakePaymentPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(MakePaymentPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
