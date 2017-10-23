# Developent notes

### Start
    git clone https://github.com/hulloanson/3dev-comp2121.git
    cd 3dev-comp2121/

### .htaccess
Rename .htaccess.dist to .htaccess

    # e.g. In bash
    mv .htaccess.dist .htaccess 
    
Also change path (`/path/to/site/root`) in RewriteCond and RewriteBase
    
    # Uncomment (remove '#') if site not at document root
    # RewriteBase "/path/to/site/root"

and 

    RewriteCond %{REQUEST_URI} !^/path/to/site/root/test\.(php|html)
    RewriteCond %{REQUEST_URI} !^/path/to/site/root/(css|js|imgs)/.*

### Add a page
Create a page in `/pages`
    
    # e.g. In Bash
    cd 3dev-comp2121/ # If you haven't already
    touch pages/hello-world.php # Create the file
    
### Access a page
Go to `your_domain.com/path/to/site/root/if/any/hello-world`
