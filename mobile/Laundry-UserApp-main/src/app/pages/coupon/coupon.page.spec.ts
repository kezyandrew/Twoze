import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { CouponPage } from './coupon.page';

describe('CouponPage', () => {
  let component: CouponPage;
  let fixture: ComponentFixture<CouponPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CouponPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(CouponPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
