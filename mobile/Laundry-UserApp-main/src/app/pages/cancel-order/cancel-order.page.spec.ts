import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { CancelOrderPage } from './cancel-order.page';

describe('CancelOrderPage', () => {
  let component: CancelOrderPage;
  let fixture: ComponentFixture<CancelOrderPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CancelOrderPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(CancelOrderPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
