package model;

public class User {
    private int id;
    private String username;
    private Integer securityNumber;
    private String name;
    private String pictureFile;
    private String familyMembers;

    public User(int id, String username, Integer securityNumber, String name, String pictureFile, String familyMembers) {
        this.id = id;
        this.username = username;
        this.securityNumber = securityNumber;
        this.name = name;
        this.pictureFile = pictureFile;
        this.familyMembers = familyMembers;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public Integer getSecurityNumber() {
        return securityNumber;
    }

    public void setSecurityNumber(Integer securityNumber) {
        this.securityNumber = securityNumber;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getPictureFile() {
        return pictureFile;
    }

    public void setPictureFile(String pictureFile) {
        this.pictureFile = pictureFile;
    }

    public String getFamilyMembers() {
        return familyMembers;
    }

    public void setFamilyMembers(String familyMembers) {
        this.familyMembers = familyMembers;
    }

    @Override
    public String toString() {
        return "User{" +
                "id=" + id +
                ", username='" + username + '\'' +
                ", securityNumber=" + securityNumber +
                ", name='" + name + '\'' +
                ", pictureFile='" + pictureFile + '\'' +
                ", familyMembers='" + familyMembers + '\'' +
                '}';
    }
}
