import {NgModule} from '@angular/core';
import {BrowserModule} from '@angular/platform-browser';
import {AppComponent} from './components';
import {AppModule} from './app.module';
import {BrowserTransferStateModule} from '../sys';
import {BrowserAnimationsModule} from "@angular/platform-browser/animations";

@NgModule({
    bootstrap: [AppComponent],
    imports: [
        BrowserModule.withServerTransition({
            appId: process.env.APP_ID
        }),
        BrowserTransferStateModule,
        BrowserAnimationsModule,
        AppModule
    ]
})
export class BrowserAppModule {
}
