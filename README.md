1. Run demo: 

Pull source then run "compose install" to install all library first

- Terminal 1 - SSO Server : php -S localhost:9000 -t examples/server/
- Terminal 2 - Sevice 1 :  export SSO_SERVER=http://localhost:9000 SSO_BROKER_ID=Alice SSO_BROKER_SECRET=8iwzik1bwd; php -S localhost:9001 -t examples/broker/
- Terminal 2 - Sevice 2 :  export SSO_SERVER=http://localhost:9000 SSO_BROKER_ID=Greg SSO_BROKER_SECRET=7pypoox2pc; php -S localhost:9002 -t examples/broker/
- Terminal 2 - Sevice 3 :  export SSO_SERVER=http://localhost:9000 SSO_BROKER_ID=Julias SSO_BROKER_SECRET=ceda63kmhp; php -S localhost:9003 -t examples/ajax-broker/

Link:
- http://localhost:9001
- http://localhost:9002 
- http://localhost:9003

Account test: jackie/jackie123 john/john123

2. Lib: https://github.com/legalthings/sso

3. Doc:
    - https://github.com/legalthings/sso/wiki
    - https://en.wikipedia.org/wiki/Single_sign-on 
    - https://en.wikipedia.org/wiki/Security_Assertion_Markup_Language
