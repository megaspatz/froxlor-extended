# An unofficial froxlor-fork

The server administration software for your needs.
Developed by experienced server administrators, this panel simplifies the effort of managing your hosting platform.

> The additional features of this fork are developed and tested on Debian only! The config-files under "Server -> Configuration"
> for non-debian distributions (including ubuntu) are from original froxlor upstream. The additional features will not work on these distributions!

## Additional Features

* Terminationdate for domains (+shsh-1)  
  Terminated, but still ongoing Domains receive an orange background in the list of domains (admin / customer)  
  expired domains get a red background  

* E-mail processing
  Customers can choose per e-mail address if e-mails accepted, rejected or discarded by postfix.
(so you can block individual addresses, although a catchall address is active)).

## Installation

1. Ensure that your webserver serves /var/www
2. Clone from GitHub
  
> git clone https://github.com/megaspatz/Froxlor.git froxlor  

3. Point your browser to http://[ip-of-webserver]/froxlor
4. Follow the installer
5. Login as administrator
6. Adjust "Server > Settings" according to your needs
7. Choose your distribution under "Server > Configuration"
8. Follow the steps for your services
9. Have fun!

## The version number
Example: 0.9.34.1+shsh-1  
The front part corresponds to the merged upstream version (0.9.34.1), the rear part corresponds 
to the version of the additional features (+shsh-1, see above).

## License

May be found in COPYING
